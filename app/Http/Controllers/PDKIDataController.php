<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PDKIDataController extends Controller
{
    /**
     * Get PDKI Data from API
     */
    public function get_pdki(String $brand): Array
    {
        $data = Http::withHeaders([
            "Pdki-Signature" => "PDKI/c127987ca9ededcec7afa7656cb9c194b702b6f5e7ca21e5502b311626a1b7826b77ac1335c908ecb993c25735186119a46703230afd6d2b6948774232d99db1"
        ])->get("https://pdki-indonesia.dgip.go.id/api/search?keyword='$brand'&page=1&showFilter=true&type=trademark")->json();

        return $data;
    }
}
