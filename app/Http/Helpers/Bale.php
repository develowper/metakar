<?php

namespace App\Http\Helpers;

use App\Http\Controllers\Api\v2\User;
use App\Models\Category;
use App\Models\Contact;
use App\Models\County;
use App\Models\Marketer;
use App\Models\Province;
use App\Models\Sport;
use App\Models\Tournament;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use DateTimeZone;
use Morilog\Jalali\Jalalian;

class Bale
{

    const LOGS = [733349193 /* my id*/, 1451976064 /*beheshti id*/, 4514116196 /*group*/,];

    static function sendMessage($chat_id, $text, $mode = null, $reply = null, $keyboard = null, $disable_notification = false, $app_id = null)
    {

        return self::creator('sendMessage', [

            'chat_id' => $chat_id,

            'text' => $text,
            'parse_mode' => $mode,
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard,
            'disable_notification' => $disable_notification,
        ]);


    }

    static function deleteMessage($chatid, $massege_id)
    {
        return self::creator('DeleteMessage', [
            'chat_id' => $chatid,
            'message_id' => $massege_id
        ]);
    }

    static function sendPhoto($chat_id, $photo, $caption, $reply = null, $keyboard = null)
    {


        return self::creator('sendPhoto', [
            'chat_id' => $chat_id,
            'photo' => $photo,
            'caption' => $caption,
            'parse_mode' => 'Markdown',
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard
        ]);

    }


    static function sendMediaGroup($chat_id, $media, $keyboard = null, $reply = null)
    {
//2 to 10 media can be send

        return self::creator('sendMediaGroup', [
            'chat_id' => $chat_id,
            'media' => json_encode($media),
            'reply_to_message_id' => $reply,

        ]);

    }

    static function sendSticker($chat_id, $file_id, $keyboard, $reply = null, $set_name = null)
    {
        return self::creator('sendSticker', [
            'chat_id' => $chat_id,
            'sticker' => $file_id,
            "set_name" => $set_name,
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard
        ]);
    }


    static function logAdmins($msg, $mode = null)
    {
        foreach (Helper::$logs as $log)
            self::sendMessage($log, $msg, $mode);

    }

    static function creator($method, $datas = [])
    {

        $url = "https://tapi.bale.ai/" . env('BALE_BOT_TOKEN', 'YOUR-BOT-TOKEN') . "/" . $method;
        return \Http::asForm()->post($url, $datas);


    }

    static function MarkDown($string)
    {
        $string = str_replace(["_",], '\_', $string);
        $string = str_replace(["`",], '\`', $string);
        $string = str_replace(["*",], '\*', $string);
        $string = str_replace(["~",], '\~', $string);


        return $string;
    }

    static function log($to, $type, $data)
    {

        try {
            if (!str_contains(request()->url(), '.ir') && !str_contains(request()->url(), '.com'))
                return;
            if ($data instanceof \App\Models\User)
                $us = $data;
            elseif (isset($data->user_id))
                if (isset($data->user_type) && $data->user_type == Marketer::class)
                    $us = \App\Models\Marketer::find($data->user_id);
                else  $us = \App\Models\User::find($data->user_id);
            else
                $us = auth()->user() ?? auth('api')->user();
            $admin = isset ($us) && (in_array($us->tel, ['09351414815', '09018945844']));
            $now = Jalalian::forge('now', new DateTimeZone('Asia/Tehran'));
            $time = $now->format('%A, %d %B %Y ⏰ H:i');
            $msg = config('app.name') . PHP_EOL . $time . PHP_EOL;
            $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;

            switch ($type) {
                case 'contact_created':
                    $contact = new Contact();
                    $contact = $data;
                    $user = \App\Models\User::firstOrNew(['id' => $data->user_id]);
                    $msg .= " 🟢 " . "یک پیام ثبت شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نویسنده: " . PHP_EOL;
                    $msg .= ($user->fullname) . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس" . PHP_EOL;
                    $msg .= $user->mobile . PHP_EOL;
                    $msg .= " 📧 " . "ایمیل: " . PHP_EOL;
                    $msg .= $user->email . PHP_EOL;
                    $msg .= " 📃 " . "عنوان" . PHP_EOL;
                    $msg .= $contact->title . PHP_EOL;
                    $msg .= " 📌 " . "متن" . PHP_EOL;
                    $msg .= $contact->text . PHP_EOL;

                    break;
                case 'user_created':

                    $msg .= "یک کاربر ساخته شد" . PHP_EOL;
                    $msg .= "شناسه: " . $data->user_id . PHP_EOL;
                    $msg .= ($data->is_lawyer ? "وکیل " : ($data->is_expert ? "کارشناس" : "کاربر عادی")) . PHP_EOL;
                    $msg .= " 👤 " . $data->fullname . PHP_EOL;
                    $marketer = $data->marketer_code ? User::where('marketing_code', $data->marketer_code)->first() : null;
                    if ($marketer)
                        $msg .= " 🤳 " . "$marketer->first_name $marketer->last_name | $marketer->mobile" . PHP_EOL;
                    $msg .= " 🔢 " . $data->app_version . PHP_EOL;
                    $msg .= " 📥 " . ($data->market) . PHP_EOL;
                    $msg .= " 📱 " . $data->mobile . PHP_EOL;
//                    $msg .= " 📧 " . $data->email . PHP_EOL;
                    $msg .= " 📣 " . $data->marketing_code . PHP_EOL;
                    break;
                case 'marketer_created':

                    $msg .= " 🟡 " . "یک بازاریاب ساخته شد" . PHP_EOL;
                    $msg .= "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "$data->first_name $data->last_name" . PHP_EOL;
                    $msg .= " کد بازاریابی " . $data->identifier_code . PHP_EOL;
                    $msg .= " 📱 " . $data->mobile . PHP_EOL;
                    $msg .= " 💸 " . $data->bank_cart . PHP_EOL;
                    $msg .= " 💸 " . $data->bank_shaba . PHP_EOL;

                    break;
                case 'user_created':

                    $msg .= " 🟢 " . "یک کاربر ساخته شد" . PHP_EOL;
                    $msg .= " 🆔 " . "شناسه: " . $data->user_id . PHP_EOL;
                    $msg .= " 🚩 " . ($data->is_lawyer ? "وکیل " : "کاربر عادی") . PHP_EOL;
                    $msg .= " 👤 " . "نام " . PHP_EOL;
                    $msg .= $data->fullname . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس" . PHP_EOL;
                    $msg .= $data->mobile . PHP_EOL;
                    $msg .= " 📧 " . "ایمیل: " . PHP_EOL;
                    $msg .= $data->email . PHP_EOL;
                    break;
                case 'transaction_created':
                    if ($data->amount > 0 && !str_starts_with($data->type, "p_"))
                        $msg .= " 🟢🟢🟢🛒 " . "یک تراکنش انجام شد" . PHP_EOL;
                    elseif (str_starts_with($data->type, "p_"))
                        $msg .= " 🟡🟡🟡🛒 " . "یک پورسانت ثبت شد" . PHP_EOL;
                    else
                        $msg .= " 🟠🟠🟠🛒 " . "یک پلن خریداری شد" . PHP_EOL;
                    $msg .= " 🆔 " . "شناسه کاربر: " . $data->user_id . PHP_EOL;
                    $type = $us instanceof Marketer ? "بازاریاب" : ($us->is_lawyer ? "وکیل" : ($us->is_expert ? 'کارشناس' : 'کاربر عادی'));
                    $msg .= " 🚩 " . ($type) . PHP_EOL;
                    $msg .= " 👤 " . "نام " . PHP_EOL;
                    $msg .= isset($us->first_name) ? "$us->first_name $us->last_name" : $us->fullname . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس" . PHP_EOL;
                    $msg .= $us->mobile . PHP_EOL;
                    $msg .= " ⭐ " . "نوع" . PHP_EOL;
                    $msg .= $data->title . PHP_EOL;
                    $msg .= " 🧿 " . "کد تراکنش: ";
                    $msg .= (isset(\App\Helpers\Helper::$PAY_TYPES[$data->type]) ? \App\Helpers\Helper::$PAY_TYPES[$data->type] : $data->type) . PHP_EOL;
                    $msg .= " 📊 " . "مقدار" . PHP_EOL;
                    $msg .= $data->amount . PHP_EOL;

                    break;
                case 'admin_log':
                    $msg .= " 🔔 " . "گزارش 24 ساعت دبل عدل" . PHP_EOL;
                    $msg .= PHP_EOL . "\xD8\x9C" . "🟥 🟧 🟨 🟩 🟦 🟪" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖آمار کلی➖" . PHP_EOL;
                    $msg .= "کاربر: " . number_format(User::where('is_lawyer', false)->where('is_expert', false)->count()) . PHP_EOL;
                    $msg .= "وکیل/کارشناس: " . number_format(User::where('is_lawyer', true)->orWhere('is_expert', true)->count()) . PHP_EOL;
                    $msg .= "بازاریاب: " . number_format(Marketer::count()) . PHP_EOL;
                    $msg .= "مجموع خرید: " . number_format(WalletTransaction::where('title', 'like', 'شارژ%')->sum('amount')) . " تومان " . PHP_EOL;
                    $msg .= PHP_EOL . "\xD8\x9C" . "🟥 🟧 🟨 🟩 🟦 🟪" . PHP_EOL . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖آمار 24 ساعت➖" . PHP_EOL;
                    $time = Carbon::now()->subHours(24);
                    $msg .= "کاربر: " . number_format(User::where('created_at', '>', $time)->where('is_lawyer', false)->where('is_expert', false)->count()) . PHP_EOL;
                    $msg .= "وکیل/کارشناس: " . number_format(User::where('created_at', '>', $time)->where('is_lawyer', true)->orWhere('is_expert', true)->count()) . PHP_EOL;
                    $msg .= "بازاریاب: " . number_format(Marketer::where('created_at', '>', $time)->count()) . PHP_EOL;
                    $msg .= "مجموع خرید: " . number_format(WalletTransaction::where('created_at', '>', $time)->where('title', 'like', 'شارژ%')->sum('amount')) . " تومان " . PHP_EOL;

                    break;
                case 'video_edited':
                    $user = \App\Models\User::firstOrNew(['id' => $data->user_id]);
                    $msg .= " 🟢 " . "یک ویدیو ویرایش شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نویسنده: " . PHP_EOL;
                    $msg .= ($user->name ? "$user->name $user->family" : "$user->username") . PHP_EOL;
                    $msg .= " 📃 " . "عنوان" . PHP_EOL;
                    $msg .= $data->title . PHP_EOL;
                    $msg .= " ⭐ " . "دسته" . PHP_EOL;
                    $msg .= Category::find($data->category_id)->name . PHP_EOL;
                    $msg .= url('') . '/storage/' . Helper::$docsMap['videos'] . '/' . $data->id . '.jpg' . '?r=' . random_int(10, 1000) . PHP_EOL;
                    $msg .= url('') . '/storage/' . Helper::$docsMap['videos'] . '/' . $data->id . '.mp4' . '?r=' . random_int(10, 1000) . PHP_EOL;
                    $msg .= " 📌 " . url('video') . "/$data->id/" . PHP_EOL;
                    break;
                case 'agency_created':
                    $msg .= " 🟢 " . "یک نمایندگی ساخته شد" . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ : " . PHP_EOL . Jalalian::fromDateTime($data->updated_at)->format('%Y/%m/%d ⏰ H:i') . PHP_EOL;
                    $msg .= " 👤 " . "سازنده" . PHP_EOL;
                    $msg .= ($us->name ? "$us->name $us->family" : "$us->username") . PHP_EOL;
                    $parent = \App\Models\Agency::find($data->parent_id);
                    if ($parent) {
                        $msg .= " 👤 " . "نمایندگی والد" . PHP_EOL;
                        $msg .= ($parent->name . ' 📱 ' . $parent->phone) . PHP_EOL;
                    }
                    $msg .= " 👤 " . "مالک" . PHP_EOL;
                    $owner = \App\Models\User::findOrNew($data->owner_id);
                    $msg .= ($owner->name ? "$owner->name $owner->family" : "$owner->username") . PHP_EOL;
                    $msg .= " 📌 " . "نام نمایندگی" . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "آدرس: " . $data->address . PHP_EOL;
                    $msg .= " 📧 " . "ایمیل: " . PHP_EOL;
                    $msg .= $data->email . PHP_EOL;
                    $msg .= " 📱 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'agency_edited':
                    $msg .= " 🟧 " . " $attribute " . "یک نمایندگی ویرایش شد" . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ : " . PHP_EOL . Jalalian::fromDateTime($data->updated_at)->format('%Y/%m/%d ⏰ H:i') . PHP_EOL;
                    $msg .= " 👤 " . "سازنده" . PHP_EOL;
                    $msg .= ($us->name ? "$us->name $us->family" : "$us->username") . PHP_EOL;
                    $msg .= " 👤 " . "مالک" . PHP_EOL;
                    $owner = \App\Models\User::findOrNew($data->owner_id);
                    $msg .= ($owner->name ? "$owner->name $owner->family" : "$owner->username") . PHP_EOL;
                    $msg .= " 📌 " . "نام نمایندگی" . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "آدرس: " . $data->address . PHP_EOL;
                    $msg .= " 📧 " . "ایمیل: " . PHP_EOL;
                    $msg .= $data->email . PHP_EOL;
                    $msg .= " 📱 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'table_created':
                    $msg .= " 🟢 " . "یک جدول ساخته شد" . PHP_EOL;
                    $msg .= " 👤 " . "سازنده" . PHP_EOL;
                    $msg .= ($us->name ? "$us->name $us->family" : "$us->username") . PHP_EOL;
                    $msg .= " 📌 " . "عنوان" . PHP_EOL;
                    $msg .= $data->title . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ : " . PHP_EOL . Jalalian::fromDateTime($data->updated_at)->format('%Y/%m/%d ⏰ H:i') . PHP_EOL;
                    $msg .= " 🚩 " . "تورنومنت" . PHP_EOL;
                    $msg .= optional(Tournament::find($data->tournament_id))->name . PHP_EOL;


                    break;
                case 'event_created':
                    $msg .= " 🟢 " . "یک رویداد ساخته شد" . PHP_EOL;
                    $msg .= " 👤 " . "سازنده" . PHP_EOL;
                    $msg .= ($us->name ? "$us->name $us->family" : "$us->username") . PHP_EOL;
                    $msg .= " 📌 " . "عنوان" . PHP_EOL;
                    $msg .= $data->title . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ : " . PHP_EOL . Jalalian::fromDateTime($data->time, new DateTimeZone('Asia/Tehran'))->format('%Y/%m/%d ⏰ H:i') . PHP_EOL;
                    $msg .= " 🚩 " . "آیتم 1" . PHP_EOL;
                    $msg .= $data->team1 . PHP_EOL;
                    $msg .= " 🚩 " . "آیتم 2" . PHP_EOL;
                    $msg .= $data->team2 . PHP_EOL;
                    $msg .= " 📊 " . "وضعیت" . PHP_EOL;
                    $msg .= $data->status . PHP_EOL;
                    $msg .= " ⭐ " . "دسته" . PHP_EOL;
                    $msg .= Sport::find($data->sport_id)->name . PHP_EOL;
                    $msg .= " 📃 " . "جزییات: " . PHP_EOL . $data->details . PHP_EOL;

                    break;
                case 'event_edited':
                    $msg .= " 🟢 " . "یک رویداد ویرایش شد" . PHP_EOL;
                    $msg .= " 👤 " . "سازنده" . PHP_EOL;
                    $msg .= ($us->name ? "$us->name $us->family" : "$us->username") . PHP_EOL;
                    $msg .= " 📌 " . "عنوان" . PHP_EOL;
                    $msg .= $data->title . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ : " . PHP_EOL . Jalalian::fromDateTime($data->time, new DateTimeZone('Asia/Tehran'))->format('%Y/%m/%d ⏰ H:i') . PHP_EOL;
                    $msg .= " 🚩 " . "آیتم 1" . PHP_EOL;
                    $msg .= $data->team1 . PHP_EOL;
                    $msg .= " 🚩 " . "آیتم 2" . PHP_EOL;
                    $msg .= $data->team2 . PHP_EOL;
                    $msg .= " 📊 " . "وضعیت" . PHP_EOL;
                    $msg .= $data->status . PHP_EOL;
                    $msg .= " ⭐ " . "دسته" . PHP_EOL;
                    $msg .= Sport::find($data->sport_id)->name . PHP_EOL;
                    $msg .= " 📃 " . "جزییات: " . PHP_EOL . $data->details . PHP_EOL;

                    break;

                case 'player_created':
                    $msg .= " 🟡 " . "یک بازیکن ساخته شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . ' ' . $data->family . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " 🧬 " . "جنسیت: " . ($data->is_man ? 'مرد' : 'زن') . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ تولد: " . Jalalian::fromDateTime($data->born_at)->format('%Y/%m/%d') . PHP_EOL;
                    $msg .= " 📏 " . "قد: " . $data->height . PHP_EOL;
                    $msg .= " ⚓ " . "وزن: " . $data->weight . PHP_EOL;
                    $msg .= " ⭐ " . "رشته ورزشی: " . Sport::firstOrNew(['id' => $data->sport_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 📱 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'coach_created':
                    $msg .= " 🟠 " . "یک مربی ساخته شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . ' ' . $data->family . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " 🧬 " . "جنسیت: " . ($data->is_man ? 'مرد' : 'زن') . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ تولد: " . Jalalian::fromDateTime($data->born_at)->format('%Y/%m/%d') . PHP_EOL;
                    $msg .= " ⭐ " . "رشته ورزشی: " . Sport::firstOrNew(['id' => $data->sport_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 📱 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'club_created':
                    $msg .= " 🔵 " . "یک باشگاه ساخته شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " ⭐ " . "رشته ورزشی: " . implode(', ', collect(json_decode($data->times))->map(function ($el) {
                            return Sport::firstOrNew(['id' => $el->id])->name;
                        })->toArray()) . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "آدرس: " . $data->address . PHP_EOL;
                    $msg .= " 📱 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'shop_created':
                    $msg .= " 🟣 " . "یک فروشگاه ساخته شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "آدرس: " . $data->address . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'product_created':
                    $shop = \App\Models\Shop::firstOrNew(['id' => $data->shop_id]);
                    $msg .= " ⚫️ " . "یک محصول ساخته شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 📈 " . "قیمت اصلی: " . PHP_EOL;
                    $msg .= $data->price . PHP_EOL;
                    $msg .= " 📉 " . "قیمت با تخفیف: " . PHP_EOL;
                    $msg .= $data->discount_price . PHP_EOL;
                    $msg .= " 📊 " . "تعداد: " . PHP_EOL;
                    $msg .= $data->count . PHP_EOL;
                    $msg .= " 🚩 " . "دسته بندی: " . Sport::firstOrNew(['id' => $data->group_id])->name . PHP_EOL;
                    $msg .= " 🛒 " . "فروشگاه: " . PHP_EOL;
                    $msg .= $shop->name . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $shop->phone . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'blog_created':
                    $user = \App\Models\User::firstOrNew(['id' => $data->user_id]);
                    $msg .= " 🟤 " . "یک خبر اضافه شد" . PHP_EOL;

                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نویسنده: " . PHP_EOL;
                    $msg .= ($user->name ? "$user->name $user->family" : "$user->username") . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $user->phone . PHP_EOL;
                    $msg .= " 📌 " . url('blog') . "/$data->id/" . str_replace(' ', '-', $data->title) . PHP_EOL;

                    break;

                case 'payment':
                    $user = \App\Models\User::firstOrNew(['id' => $data->user_id]);
                    $msg .= " ✔️ " . "یک پرداخت انجام شد" . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $msg .= " 🆔 " . "شماره سفارش: " . PHP_EOL . $data->order_id . PHP_EOL;
                    $msg .= " 💸 " . "مبلغ(ت): " . PHP_EOL . $data->amount . PHP_EOL;
                    $msg .= " 👤 " . "کاربر: " . PHP_EOL;
                    $msg .= ($user->name ? "$user->name $user->family" : "$user->username") . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $user->phone . PHP_EOL;
                    $msg .= " 🧾 " . "پیگیری شاپرک: " . PHP_EOL;
                    $msg .= $data->Shaparak_Ref_Id . PHP_EOL;
                    $msg .= " 📦 " . "محصول: " . PHP_EOL;
                    $msg .= $data->pay_for . PHP_EOL;

                    break;
                case 'user_edited':
                    $msg .= " 🟥 " . ($admin ? "ادمین *$admin* یک کاربر را ویرایش کرد" : "یک کاربر ویرایش شد") . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . ' ' . $data->family . PHP_EOL;
                    $msg .= " 📧 " . "ایمیل: " . PHP_EOL;
                    $msg .= $data->email . PHP_EOL;
                    $msg .= " ⚙️ " . "نام کاربری" . PHP_EOL;
                    $msg .= $data->username . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس" . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    break;

                case 'player_edited':
                    $msg .= " 🟧 " . ($admin ? "ادمین *$admin* $attribute یک بازیکن را ویرایش کرد" : " $attribute یک بازیکن ویرایش شد") . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . ' ' . $data->family . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " 🧬 " . "جنسیت: " . ($data->is_man ? 'مرد' : 'زن') . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ تولد: " . Jalalian::fromDateTime($data->born_at)->format('%Y/%m/%d') . PHP_EOL;
                    $msg .= " 📏 " . "قد: " . $data->height . PHP_EOL;
                    $msg .= " ⚓ " . "وزن: " . $data->weight . PHP_EOL;
                    $msg .= " ⭐ " . "رشته ورزشی: " . Sport::firstOrNew(['id' => $data->sport_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'coach_edited':
                    $msg .= " 🟨 " . ($admin ? "ادمین *$admin* $attribute یک مربی را ویرایش کرد" : " $attribute یک مربی ویرایش شد") . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . ' ' . $data->family . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " 🧬 " . "جنسیت: " . ($data->is_man ? 'مرد' : 'زن') . PHP_EOL;
                    $msg .= " 📅 " . "تاریخ تولد: " . Jalalian::fromDateTime($data->born_at)->format('%Y/%m/%d') . PHP_EOL;
                    $msg .= " ⭐ " . "رشته ورزشی: " . Sport::firstOrNew(['id' => $data->sport_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'club_edited':
                    $msg .= " 🟩 " . ($admin ? "ادمین *$admin* $attribute یک باشگاه را ویرایش کرد" : " $attribute یک باشگاه ویرایش شد") . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " ⭐ " . "رشته ورزشی: " . implode(', ', collect(json_decode($data->times))->map(function ($el) {
                            return Sport::firstOrNew(['id' => $el->id])->name;
                        })->toArray()) . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "آدرس: " . $data->address . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'shop_edited':
                    $msg .= " 🟦 " . ($admin ? "ادمین *$admin* $attribute یک فروشگاه را ویرایش کرد" : " $attribute یک فروشگاه ویرایش شد") . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $data->phone . PHP_EOL;
                    $msg .= " 🚩 " . "استان: " . Province::firstOrNew(['id' => $data->province_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "شهر: " . County::firstOrNew(['id' => $data->county_id])->name . PHP_EOL;
                    $msg .= " 🚩 " . "آدرس: " . $data->address . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;

                case 'product_edited':
                    $shop = \App\Models\Shop::firstOrNew(['id' => $data->shop_id]);
                    $msg .= " 🟪 " . ($admin ? "ادمین *$admin* $attribute یک محصول را ویرایش کرد" : " $attribute یک محصول ویرایش شد") . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $docs = $data->docs;
                    foreach ($docs as $doc) {
                        $msg .= url('') . '/storage/' . $doc->type_id . '/' . $doc['id'] . '.' . ($doc['type_id'] == Helper::$docsMap['video'] ? 'mp4' : 'jpg') . '?r=' . random_int(10, 1000) . PHP_EOL;
                    }
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 📈 " . "قیمت اصلی: " . PHP_EOL;
                    $msg .= $data->price . PHP_EOL;
                    $msg .= " 📉 " . "قیمت با تخفیف: " . PHP_EOL;
                    $msg .= $data->discount_price . PHP_EOL;
                    $msg .= " 📊 " . "تعداد: " . PHP_EOL;
                    $msg .= $data->count . PHP_EOL;
                    $msg .= " 🚩 " . "دسته بندی: " . Sport::firstOrNew(['id' => $data->group_id])->name . PHP_EOL;
                    $msg .= " 🛒 " . "فروشگاه: " . PHP_EOL;
                    $msg .= $shop->name . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $shop->phone . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;
                case 'product_deleted':
                    $shop = \App\Models\Shop::firstOrNew(['id' => $data->shop_id]);
                    $msg .= " 📛 " . ($admin ? "ادمین *$admin* یک محصول را حذف کرد" : "یک محصول حذف شد") . PHP_EOL;
                    $msg .= "\xD8\x9C" . "➖➖➖➖➖➖➖➖➖➖➖" . PHP_EOL;
                    $msg .= " 🆔 " . "شناسه: " . $data->id . PHP_EOL;
                    $msg .= " 👤 " . "نام: " . PHP_EOL;
                    $msg .= $data->name . PHP_EOL;
                    $msg .= " 📈 " . "قیمت اصلی: " . PHP_EOL;
                    $msg .= $data->price . PHP_EOL;
                    $msg .= " 📉 " . "قیمت با تخفیف: " . PHP_EOL;
                    $msg .= $data->discount_price . PHP_EOL;
                    $msg .= " 📊 " . "تعداد: " . PHP_EOL;
                    $msg .= $data->count . PHP_EOL;
                    $msg .= " 🚩 " . "دسته بندی: " . Sport::firstOrNew(['id' => $data->group_id])->name . PHP_EOL;
                    $msg .= " 🛒 " . "فروشگاه: " . PHP_EOL;
                    $msg .= $shop->name . PHP_EOL;
                    $msg .= " 📱 " . "شماره تماس: " . PHP_EOL;
                    $msg .= $shop->phone . PHP_EOL;
                    $msg .= " 📃 " . "توضیحات: " . $data->description . PHP_EOL;

                    break;
                case 'error':
                    $msg = ' 📛 ' . ' خطای سیستم ' . PHP_EOL . $data;
                    break;
                default :
                    $msg = $data;
            }
            $msg .= "🅳🅰🅱🅴🅻🅰🅳🅻" . PHP_EOL;
//            self::sendMessage($to, $msg, null);
            self::sendMessage(\App\Helpers\Helper::$logs[0], $msg, null);
            self::sendMessage(\App\Helpers\Helper::$logs[1], $msg, null);

        } catch (\Exception $e) {
            self::sendMessage(\App\Helpers\Helper::$logs[0], $e->getMessage() . " | " . $e->getFile() . " | " . $e->getLine(), null);

        }
    }
}
