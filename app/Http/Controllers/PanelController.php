<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PanelController extends Controller
{
    public function __construct()
    {

    }

    public static function makeInertiaRoute(string $method, string $route, string $name, string $component, array $params = [])
    {
        return Route::match([$method], $route, function () use ($component) {

            return Inertia::render($component, []);
        })->name($name);
    }

    protected function index(Request $request)
    {
        $params = [];
        $user = auth()->user();
        $role = optional($user)->role;
        if ($role == 'go') {
            $component = 'Panel/God/Index';
            $params = [
                'users' => User::select('role', DB::raw('COUNT(*) AS count'))->groupBy('role')->get(),
                'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->groupBy('type')->get(),
                'tickets' => Ticket::select('status', DB::raw('COUNT(*) AS count'))->groupBy('status')->get(),

            ];

        } elseif ($role == 'ad') {
            $component = 'Panel/Admin/Index';
            $params = [
                'users' => User::select('role', DB::raw('COUNT(*) AS count'))->groupBy('role')->get(),
                'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->groupBy('type')->get(),
                'tickets' => Ticket::select('status', DB::raw('COUNT(*) AS count'))->groupBy('status')->get(),

            ];
        } else {
            $component = 'Panel/Index';
            $params = [
                'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->where('user_id', optional($user)->id)->groupBy('type')->get(),
                'tickets' => Ticket::select('status', DB::raw('COUNT(*) AS count'))->where('user_id', optional($user)->id)->groupBy('status')->get(),

            ];
        }

        return Inertia::render($component, $params);
    }
}
