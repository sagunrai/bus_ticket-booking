<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public static function sendsms($phone, $msg = null){

        $token = config('app.SPARROW_SMS');
        $args = http_build_query(array(
            'token' => $token,
            // 'token' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            'from'  => 'InfoAlert',
            'to'    => $phone,
            'text'  => $msg
        ));

        $url = "http://api.sparrowsms.com/v2/sms/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return true;
    }
}
