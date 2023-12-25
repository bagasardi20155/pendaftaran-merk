<?php

namespace App\Http\Controllers;

use App\Models\Applicant\Brand;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $active = "Home";

        //visitor counter
        $ip = $request->ip();
        $today_visitor = Visitor::where('date', Carbon::today())->firstOrCreate([
            'ip_address' => $ip,
            'date' => Carbon::today(),
        ]);
        $visitors = Visitor::where('date', Carbon::today())->count();

        //input brand
        $input = $request->input('input');
        //data pdki
        $data = $request->input('data');

        return view('welcome', compact('visitors', 'active', 'input', 'data'));
    }

    public function get_data(PDKIDataController $pdki, Request $request)
    {
        //get search result
        if($request != null)
        {
            //input name brand
            $input = $request->name;

            //get data pdki and send to route home
            $req_pdki = $pdki->get_pdki($request->name);
            $data_pdki = [];
            foreach ($req_pdki['hits']['hits'] as $hits)
            {
                array_push($data_pdki, [
                    'name' => $hits['_source']['nama_merek'],
                    'logo' => $hits['_source']['image'][0]['image_path'],
                    'tgl_pengajuan' => $hits['_source']['tanggal_permohonan'],
                ]);
            }
            
            $data_local = Brand::whereRaw("SOUNDEX(name) = SOUNDEX('$request->name')")->get([
                'name',
                'logo',
                'created_at',
            ])->toArray();
                
            $data = array_merge($data_pdki, $data_local);
            
            return redirect()->route('home', [
                'data' => $data,
                'input' => $input,
            ]);
        } else {
            return redirect()->route('home', ['data' => null]);
        }

    }
}
