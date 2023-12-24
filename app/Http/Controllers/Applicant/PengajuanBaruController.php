<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Administrator\PermohonanController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PDKIDataController;
use App\Http\Requests\Applicant\PengajuanBaruRequest;
use App\Http\Requests\Applicant\UpdateAjuanRequest;
use App\Models\Applicant\Brand;
use App\Models\Applicant\BrandStatus;
use App\Services\Applicant\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanBaruController extends Controller
{
    /**
     * Display the pengajuan merk form.
     */
    public function index(): View
    {
        $active = 'pengajuan-baru';
        return view('applicant.pengajuan-baru', compact('active'));
    }
    /**
     * Display the pengajuan merk form.
     */
    public function create(): View
    {
        $active = 'pengajuan-baru';
        return view('applicant.pengajuan-baru', compact('active'));
    }

    /**
     * Get similarity data of brand and existing data in pdki
     */
    public function get_data_pdki(PDKIDataController $pdki, Request $request): Array
    {
        $data_pdki = $pdki->get_pdki($request->input('inputText'));
        $data = [];
        $similarity = new PermohonanController();

        foreach ($data_pdki['hits']['hits'] as $hits)
        {
            array_push($data, [
                'name' => $hits['_source']['nama_merek'],
                'akhir_perlindungan' => $hits['_source']['tanggal_berakhir_perlindungan'],
                'similarity_rate' => round($similarity->similarity_percentage($request->input('inputText'), $hits['_source']['nama_merek'])),
            ]);
        }
        return $data;
    }

    /**
     * Store the pengajuan merk form.
     */
    public function store(PengajuanBaruRequest $request): RedirectResponse
    {
        $validateData = $request->validated();
        try {
			if($request->hasFile('logo')) {
				$validateData['logo'] = FileUploadService::uploadFile($request->file('logo'), 'homepage/images/brand-logo/');
			}
            if($request->hasFile('suket_umk')) {
				$validateData['suket_umk'] = FileUploadService::uploadFile($request->file('suket_umk'), 'homepage/images/brand-suket-umk/');
			}
            if($request->hasFile('applicant_signature')) {
				$validateData['applicant_signature'] = FileUploadService::uploadFile($request->file('applicant_signature'), 'homepage/images/brand-signature/');
			}
            $pengajuan_baru = Brand::create($validateData);
            
            if ($pengajuan_baru) {
                BrandStatus::create([
                    "id_brand" => $pengajuan_baru->id,
                    "status" => "waiting",
                ]);
            }
            $msg = "Merk Anda Berhasil Diajukan";
            $tooltip = "Status Ajuan Anda : Menunggu Verifikasi Admin";
            Alert::success($msg, $tooltip);
            return Redirect::route('applicant.ajuan-merk.index');
        } catch (\Throwable $th) {
            return $this->handleError($th->getMessage(), []);
        }
    }

    /**
     * Display the pengajuan brand details
     */
    public function show($brand): View
    {
        $active = 'daftar-ajuan-merk';
        $data = Brand::find($brand);

        $status = BrandStatus::where('id_brand', $data->id)->orderBy('updated_at', 'desc')->get();
        foreach ($status as $status_single) {
            $status_history[] = $status_single->status;
        }

        return view('applicant.detail-ajuan-merk', compact('active', 'data', 'status_history', 'status'));
    }

    /**
     * Edit / Revise the pengajuan brand details
     */
    public function update(UpdateAjuanRequest $request, $brand): RedirectResponse
    {
        try {
            $data = Brand::find($brand)->update($request->validated());
            $status = BrandStatus::create([
                'id_brand' => $brand,
                'status' => 'revised',
                'message' => 'Ajuan Merk Revised'
            ]);

            $msg = "Revisi Ajuan Telah Diterima Admin";
            $tooltip = "Silakan menunggu verifikasi oleh admin kembali";
            Alert::success($msg, $tooltip);

            return Redirect::route('applicant.ajuan-merk.index');

        } catch (\Throwable $th) {
            return $this->handleError($th->getMessage(), []);
        }
    }
}
