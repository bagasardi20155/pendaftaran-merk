<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applicant\PengajuanBaruRequest;
use App\Models\Applicant\Brand;
use App\Services\Applicant\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * Store the pengajuan merk form.
     */
    public function store(PengajuanBaruRequest $request): View
    {
        $active = 'daftar-ajuan-merk';
        $validateData = $request->validated();
        // dd($active, $request->validated());
        try {
			if($request->hasFile('logo')) {
				$validateData['logo'] = FileUploadService::uploadFile($request->file('logo'), 'images/brand-logo/');
			}
            if($request->hasFile('suket_umk')) {
				$validateData['suket_umk'] = FileUploadService::uploadFile($request->file('suket_umk'), 'images/brand-suket-umk/');
			}
            if($request->hasFile('applicant_signature')) {
				$validateData['applicant_signature'] = FileUploadService::uploadFile($request->file('applicant_signature'), 'images/brand-signature/');
			}
            $pengajuan_baru = Brand::create($validateData);
            
            return view('applicant.ajuan-merk', compact('active'));
        } catch (\Throwable $th) {
            return $this->handleError($th->getMessage(), []);
        }
    }
}
