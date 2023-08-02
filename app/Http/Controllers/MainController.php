<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MainController extends Controller
{
    public function sendSms(Request $request)
    {
        sleep(1);
        return response(['message' => __('sms_send_to_phone')]);
    }

    public function makeMoneyPage()
    {

        return Inertia::render('MakeMoney', [
        ]);

    }
}
