<?php

namespace App\Services;

use App\Models\InstaMojoPayment;
use Exception;
use Illuminate\Http\Request;
use Instamojo\Instamojo;

class InstaPaymentService{
    private $api;
    private $authType = 'app';

    public function __construct()
    {
        $this->api = Instamojo::init($this->authType,[
            "client_id" =>  env('MOJO_CLIENT_ID', 'test_v9uNRGxgG45Tg0G95LMhYwGxgyO35YAOIgL'),
            "client_secret" => env('MOJO_CLIENT_SECRET', 'test_gHMTloYSF3KQCrD2XvFlsEoW5DG55VLHu6RngDHECS5esWL4Dlk0Ch77lWbG3BfUiE4y28Xrp6qgAwdwU0PFlkKTLBQf8KsMbDs5XuY5QsY7ELRrxz3G6wVvFld'),
            // "username" => 'none', /** In case of user based authentication**/
            // "password" => 'none' /** In case of user based authentication**/
        ], env('MOJO_TEST_MODE', true));
    }

    public function payment(Request $req)
    {
        try {
            $response = $this->api->createPaymentRequest(array(
                "purpose" => $req->purpose,
                "amount" => $req->amount,
                "buyer_name" => $req->buyer_name,
                "email" => $req->email,
                "phone" => $req->mobile,
                "send_email" => true,
                "send_sms" => true,
                "redirect_url" => $req->redirect_url
            ));
            // $report = $response;

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
            return $pay;
        }
        catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // After Payments / Get Report From InstaMozo Server
    public function report(Request $req)
    {
        try {
            // $payment_id = $req->payment_id;
            $payment_status = $req->payment_status;
            $pay_request_id = $req->payment_request_id;

            $response = $this->api->getPaymentRequestDetails($pay_request_id);

            $pay = InstaMojoPayment::where('payment_id', $pay_request_id)
            ->update([
                'sms_status' => $response['sms_status'],
                'email_status' => $response['email_status'],
                'payment_status' => $payment_status,
                'payments' => json_encode($response['payments'])
            ]);

            // Reports Details
            return $pay;
        }
        catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Get All Reports List From InstaMozo Server
    public function reportList()
    {
        try {
            $response = $this->api->getPaymentRequests();
            return $response;
        }
        catch (Exception $e) {
            return 'List Error: ' . $e->getMessage();
        }
    }
}
