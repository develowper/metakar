<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\SiteRequest;
use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Termwind\Components\Dd;

class SiteController extends Controller
{
    public function index()
    {
        return Inertia::render('Site/Index', [
        ]);

    }

    public function create(Request $request)
    {

        $request->merge([
            'owner_id' => $request->user()->id,
            'slug' => str_slug($request->name),
        ]);

        $site = Site::create($request->all());
        if ($site) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully')];
            Util::createImage($request->img, Variable::IMAGE_FOLDERS[Site::class], $site->id);
            Telegram::log(null, 'site_created', $site);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return to_route('panel.site.index')->with($res);
    }
}
