<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $active = "Home";

        $ip = $request->ip();
        $today_visitor = Visitor::where('date', Carbon::today())->firstOrCreate([
            'ip_address' => $ip,
            'date' => Carbon::today(),
        ]);
        $visitors = Visitor::where('date', Carbon::today())->count();
        
        return view('welcome', compact('visitors', 'active'));
    }
}
