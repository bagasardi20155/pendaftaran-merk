<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Applicant\Brand;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermohonanController extends Controller
{
    /**
     * Display the application list.
     */
    public function index(): View
    {
        $active = 'daftar-permohonan';
        return view('admin.daftar-pengguna', compact('active', 'data'));
    }
}
