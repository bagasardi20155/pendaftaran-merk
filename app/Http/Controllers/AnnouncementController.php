<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Applicant\Brand;
use App\Models\Applicant\BrandStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AnnouncementController extends Controller
{
    /**
     * Get all announcement
     */
    public function get_announcement()
    {
        $generated = Announcement::where('type', 'generated')->orderBy('updated_at', 'desc')->limit(7)->get();
        $created = Announcement::where('type', 'created')->orderBy('updated_at', 'desc')->limit(3)->get();

        $data = $generated->merge($created);
        
        return $data;
    }

    /**
     * Get all announcement and return view kelola pengumuman
     */
    public function index(): View
    {
        $active = "kelola-pengumuman";
        $data = $this->get_announcement();
        return view('admin.kelola-pengumuman', compact('active', 'data'));
    }

    /**
     * Get 7 latest data from brand and insert to announcement
     */
    public function generate(): RedirectResponse
    {
        // change status to expired
        $expired = Announcement::where('type', 'generated')->update([
            'type' => 'expired',
        ]);

        // store new announcment
        $brands = Brand::orderBy('updated_at', 'desc')->limit(7)->get(['id', 'name', 'logo', 'address', 'created_at']);
        foreach ($brands as $brand) {
            Announcement::create([
                'announcement' => $brand['name'] . "|" . $brand['logo'] . "|" . $brand['address'] . "|" . $brand['created_at'] . "|" . $brand->lastStatus()->status,
                'type' => 'generated',
            ]);
        }

        $msg = "Pengumuman berhasil digenerate!";
        $tooltip = "Untuk melihat pengumuman dapat dilakukan di icon nofitikasi";
        Alert::success($msg, $tooltip);

        return redirect()->route('admin.announcement.index');
    }
}
