<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\InstaMojoPayment;
use App\Models\Money;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Instamojo\Instamojo;

class PaymentController extends Controller
{
    private $api;

    public function __construct()
    {
        // Actual Server
        // $this->api = new Instamojo(
        //     '76f6824a7366d4190ea320862a56daa1', 
        //     '960a6744f56190e48467bcd3b5305a40', 
        // );

        // Test Server
        $this->api = new Instamojo(
            env('INSTA_API_KEY'), 
            env('INSTA_API_TOKEN'), 
            env('INSTA_END_POINT')
        );
    }


    public function bill(Request $req){
        $course = Course::find($req->cid);
        $mycourses = CourseAssignment::where('user_id', Auth::id())->get();
        $user = Auth::user();
        $check = false;

        foreach($mycourses as $c){
            if($c->course_id == $req->cid){
                $check = true;
            }
        }

        if($course->accessible =='free'){
            $this->free_course_assign($user->id, $course->id);
            session()->flash('status', 'You are succesefully enroll the <strong>'.$course->title.'</strong> course. Let\'s learn the course');
            return redirect('user/my-courses');
        }else{
            return view('users.bill', compact('course', 'user', 'check'));
        }
    }

    // 
    public function pay(Request $req)
    {
        try {
            $response = $this->api->paymentRequestCreate(array(
                "purpose" => $req->pps,
                "amount" => $req->amt,
                "buyer_name" => $req->name,
                "email" => $req->email,
                "phone" => $req->mobile,
                "send_email" => true,
                "send_sms" => true,
                "redirect_url" => url('/')."/payreport"
            ));
            $this->report = $response;

            // Payment Initiate
            $pay = new InstaMojoPayment();
            $pay->user_id = $req->uid;
            $pay->course_id = $req->cid;


            $pay->payment_id = $response['id'];
            $pay->buyer_name = $response['buyer_name'];
            $pay->email = $response['email'];
            $pay->phone = $response['phone'];
            $pay->purpose = $response['purpose'];
            $pay->amount = $response['amount'];
            $pay->expires_at = $response['expires_at'];
            $pay->sms_status = $response['sms_status'];
            $pay->email_status = $response['email_status'];
            $pay->payment_status = 'Pending';
            $pay->shorturl = $response['shorturl'];
            $pay->longurl = $response['longurl'];
            $pay->redirect_url = $response['redirect_url'];
            $pay->allow_repeated_payments = $response['allow_repeated_payments'];
            // $pay->payments = $response['payments'];

            $pay->save();

            // print_r($response);
            return view('users.payment', compact('pay'));
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
    }

    public function report(Request $req)
    {
        try {
            $payment_id = $req->payment_id;
            $payment_status = $req->payment_status;
            $pay_request_id = $req->payment_request_id;

            $response = $this->api->paymentRequestStatus($pay_request_id);

            InstaMojoPayment::where('payment_id', $pay_request_id)
            ->update([
                'sms_status' => $response['sms_status'],
                'email_status' => $response['email_status'],
                'payment_status' => $payment_status,
                'payments' => json_encode($response['payments'])
            ]);

            
            // Final Process
            if($payment_status == 'Credit'){
                $this->money_trasection('Add Money By Instamojo', $response['amount'], $payment_status);
                $this->money_trasection($response['purpose'].' purched', $response['amount'], 'debit');
                $this->course_assign($pay_request_id);
            }
            // print_r($response);

            return view('users.preport', compact('payment_status'));
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
    }

    public function reportList()
    {
        try {
            $response = $this->api
            ->paymentRequestsList(10, 1, 
            '2020-04-10T13:41:55.142211Z',
            '2020-04-10T13:41:55.142233Z'
        );
            print_r($response);
        }
        catch (Exception $e) {
            print('List Error: ' . $e->getMessage());
        }
    }

    private function free_course_assign($user_id, $course_id){
        $ca = CourseAssignment::firstOrCreate([
            'user_id'=> $user_id, 
            'course_id' => $course_id
        ]);
        $ca->save();
        return $ca->id;
    }

    private function course_assign($pay_request_id){
        $pay = InstaMojoPayment::where('payment_id', $pay_request_id)->first();
        $ca = CourseAssignment::firstOrCreate([
            'user_id'=> $pay->user_id, 
            'course_id' => $pay->course_id
        ]);
        $ca->save();
        return $ca->id;
    }


    private function money_trasection($purpose, $amount, $payment_status){
        $premoney = Money::where('user_id', Auth::id())->get()->last();
            $money = new Money();
            $money->user_id = Auth::id();
            $money->details = $purpose;

            // dd(strtolower($payment_status), $amount, $purpose);
            
            if(strtolower($payment_status) == 'credit'){
                $money->addition_amt = $amount;
                $money->withdraw_amt = 0;
                $money->balance_amt = ($premoney->balance_amt ?? 0) + $amount;
    
            } elseif(strtolower($payment_status) == 'debit') {
                $money->addition_amt = 0;
                $money->withdraw_amt = $amount;
                $money->balance_amt = ($premoney->balance_amt ?? 0) - $amount;
    
            } elseif(strtolower($payment_status) == 'balance') {
                $money->addition_amt = 0;
                $money->withdraw_amt = 0;
                $money->balance_amt = ($premoney->balance_amt ?? 0) + $amount;
            }

            $money->save();
    }
}
