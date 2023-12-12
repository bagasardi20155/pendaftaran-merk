<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AjuanMerkController extends Controller
{
    /**
     * Display the user's ajuan merk data.
     */
    public function index(): View
    {
        $active = 'daftar-ajuan-merk';
        return view('applicant.ajuan-merk', compact('active'));
    }
}
