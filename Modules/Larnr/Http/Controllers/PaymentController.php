<?php

namespace Modules\Larnr\Http\Controllers;

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
    private $authType = 'app';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if(isset($user)){
                if($user->user_type != 'admin'){
                    \Debugbar::disable();
                }
            }else{
                \Debugbar::disable();
            }
            return $next($request);
        });
        // Pay Auth Initiate
        $this->api = Instamojo::init($this->authType,[
            "client_id" =>  env('MOJO_CLIENT_ID', 'test_v9uNRGxgG45Tg0G95LMhYwGxgyO35YAOIgL'),
            "client_secret" => env('MOJO_CLIENT_SECRET', 'test_gHMTloYSF3KQCrD2XvFlsEoW5DG55VLHu6RngDHECS5esWL4Dlk0Ch77lWbG3BfUiE4y28Xrp6qgAwdwU0PFlkKTLBQf8KsMbDs5XuY5QsY7ELRrxz3G6wVvFld'),
            // "username" => 'none', /** In case of user based authentication**/
            // "password" => 'none' /** In case of user based authentication**/
        ], env('MOJO_TEST_MODE', true));
    }


    public function course_purchase($cid){
        $course = Course::find($cid);
        $mycourses = CourseAssignment::where('user_id', Auth::id())->get();
        $user = Auth::user();
        $check = false;

        foreach($mycourses as $c){
            if($c->course_id == $cid){
                $check = true;
            }
        }

        if($course->accessible =='free'){
            $this->free_course_assign($user->id, $course->id);
            session()->flash('status', 'You are succesefully enroll the <strong>'.$course->title.'</strong> course. Let\'s learn the course');
            return redirect('user/my-courses');
        }else{
            return view('larnr::checkouts.bill', compact('course', 'user', 'check'));
        }
    }

    //
    public function pay(Request $req)
    {
        try {
            $response = $this->api->createPaymentRequest(array(
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

            $response = $this->api->getPaymentRequestDetails($pay_request_id);

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
            $response = $this->api->getPaymentRequests();
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
