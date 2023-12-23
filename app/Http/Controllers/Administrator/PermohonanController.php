<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PDKIDataController;
use App\Http\Requests\Admin\VerificationRequest;
use App\Models\Applicant\Brand;
use App\Models\Applicant\BrandStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class PermohonanController extends Controller
{
    /**
     * Display the application list.
     */
    public function index(): View
    {
        $active = 'daftar-permohonan';
        $data = Brand::orderBy('created_at', 'desc')->get();
        return view('admin.daftar-permohonan', compact('active', 'data'));
    }

    /**
     * Get Similarity Rate of Brand Applied and PDKI Data.
     */
    public function similarity_percentage(String $brand, String $brand_pdki)
    {
        $brand = strtolower($brand);
        $brand_pdki = strtolower($brand_pdki);

        $dist = levenshtein($brand, $brand_pdki);

        // count percentage
        $str_len = strlen($brand) + strlen($brand_pdki);
        $percentage = ($str_len - $dist) / $str_len * 100;
        
        return $percentage;
    }

    /**
     * Get PDKI Data.
     */
    public function get_pdki_data(Brand $brand, PDKIDataController $pdki): Array
    {
        $data_pdki = $pdki->get_pdki($brand->name);
        // dd($data_pdki['hits']['hits'])
        $data = [];
        foreach ($data_pdki['hits']['hits'] as $hits)
        {
            array_push($data, [
                    'name' => $hits['_source']['nama_merek'],
                    'akhir_perlindungan' => $hits['_source']['tanggal_berakhir_perlindungan'],
                    'similarity_rate' => $this->similarity_percentage($brand->name, $hits['_source']['nama_merek']),
            ]);
        }
        return $data;
    }

     /**
     * Display the detail of an application.
     */
    public function detail(Brand $brand, PDKIDataController $pdki): View
    {
        $active = 'daftar-permohonan';

        $data = $brand;
        $status = BrandStatus::where('id_brand', $data->id)->orderBy('updated_at', 'desc')->get();
        foreach ($status as $status_single) {
            $status_history[] = $status_single->status;
        }

        $data_pdki = $this->get_pdki_data($brand, $pdki);

        return view('admin.detail-permohonan', compact('active', 'data', 'status_history', 'data_pdki'));
    }

    /**
     * Store judgement of verification
     */
    public function store(Brand $brand, VerificationRequest $request): RedirectResponse
    {
        try {
            $data = $brand;
            $up = BrandStatus::create($request->validated() + [
                'id_brand' => $data->id,
            ]);

            $msg = "Status Ajuan Berhasil Diubah";
            Alert::success($msg);

            return Redirect::route('admin.daftar-permohonan.index');

        } catch (\Throwable $th) {
            return $this->handleError($th->getMessage(), []);
        }

    }
}
