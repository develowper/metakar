<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Pay;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Variable;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function makeUrl(PaymentRequest $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $orderId = "{$userId}-" . floor(microtime(true) * 1000);
        $amount = $request->amount;
        $phone = $user->phone;
        $fullname = $user->fullname;
        $type = "{$userId}_charge";
        $market = $request->market ?? 'site';
        $dataId = null;
        $coupon = null;
        return Pay::makeUrl($orderId, $amount, $phone, $fullname, $userId, $type, $market, $dataId, $coupon);
    }

    public function confirm(Request $request)
    {

        return Pay::confirm($request);

    }
}
