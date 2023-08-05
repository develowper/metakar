<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SMSHelper;
use App\Http\Helpers\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class MainController extends Controller
{
    public function sendSms(Request $request)
    {
        $code = Util::generateRandomNumber(5);
        $res = (new SMSHelper())->sendOTPSMS("$request->phone", "$code", "forget");
        if ($res) {
            DB::table('sms_verify')->insert(
                ['code' => $code, 'phone' => $request->phone]
            );

            return response(['message' => __('sms_send_to_phone')]);
        }
    }

    public
    function makeMoneyPage()
    {

        return Inertia::render('MakeMoney', [
        ]);

    }
}
