<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the users list.
     */
    public function daftar_pengguna(): View
    {
        $active = 'daftar-pengguna';
        $data = User::get();
        return view('admin.daftar-pengguna', compact('active', 'data'));
    }
}
