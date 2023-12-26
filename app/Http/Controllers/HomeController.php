<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Applicant\Brand;
use App\Models\Applicant\BrandStatus;
use App\Models\Visitor;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
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

    public function get_data(PDKIDataController $pdki, Request $request): RedirectResponse
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
            
            $data_local = Brand::selectRaw("name, logo, created_at AS tgl_pengajuan")
                            ->whereRaw("SOUNDEX(name) = SOUNDEX('$request->name')")
                            ->get()
                            ->toArray();
                
            $data = array_merge($data_pdki, $data_local);
            
            return redirect()->route('home', [
                'data' => $data,
                'input' => $input,
            ]);
        } else {
            return redirect()->route('home', ['data' => null]);
        }

    }

    /**
     * Show Dashboard page
     */
    public function dashboard(Request $request)
    {
        if ($request->user()->hasRole('admin'))
        {
            $active = 'dashboard';

            //data daily
            $appl_daily = Brand::countStatus()['total_daily'];
            $appl_daily_proc = Brand::countStatus()['process_daily'];
            $appl_daily_fin = Brand::countStatus()['finish_daily'];
            
            //data monthly
            $appl_monthly = Brand::countStatus()['total_monthly'];
            $appl_monthly_proc = Brand::countStatus()['process_monthly'];
            $appl_monthly_fin = Brand::countStatus()['finish_monthly'];
            
            //data annually
            $appl_annually = Brand::countStatus()['total_annually'];
            $appl_annually_proc = Brand::countStatus()['process_annually'];
            $appl_annually_fin = Brand::countStatus()['finish_annually'];

            //data visitor monthly
            $monthly = Visitor::selectRaw('COUNT(*) as count, MONTH(date) as month')
                            ->groupBy(DB::raw('MONTH(date)'))
                            ->get();
            $dataMonthly = $monthly->pluck('count', 'month')->toArray();

            $annually = Visitor::selectRaw('COUNT(*) as count, YEAR(date) as year')
                            ->groupBy(DB::raw('YEAR(date)'))
                            ->get();
            $dataAnnually = $annually->pluck('count', 'year')->toArray();

            //data pengumuman
            $created = Announcement::where('type', 'created')->orderBy('updated_at', 'desc')->get();
            $generated = Announcement::where('type', 'generated')->orderBy('updated_at', 'desc')->limit(7)->get();
            $announcements = $created->merge($generated);

            return view('admin.dashboard', compact(
                'active', 
                'appl_daily', 'appl_daily_proc', 'appl_daily_fin',
                'appl_monthly', 'appl_monthly_proc', 'appl_monthly_fin',
                'appl_annually', 'appl_annually_proc', 'appl_annually_fin',
                'dataMonthly', 'dataAnnually',
                'announcements'
            ));
        } else {
            return redirect()->route('applicant.ajuan-merk.index');
        }
    }
}
