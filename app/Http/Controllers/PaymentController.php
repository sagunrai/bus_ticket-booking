<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public static function esewa($amount, $rid, $pid){

        $scd = config('app.ESEWA_SCD');
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data =[
            'amt'=> $amount,
            'rid'=> $rid,
            'pid'=> $pid,
            'scd'=> $scd
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $return_data = [
            'status' => $status_code,
            'respnose' => $response
        ];
        return $response;

    }

    public static function khalti($amount, $token){
        $args = http_build_query(array(
            'token' => $token,
            'amount'  => $amount * 100,
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // $key = config('app.KHALTI_SECRET_KEY');
        $headers = ["Authorization:Key xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"];
        // $headers = ["Authorization: Key " . $key];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $return_data = [
            'status' => $status_code,
            'respnose' => $response
        ];

        // dd($response);
        return $return_data;
    }
}
