<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Applicant\Brand;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

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

    /**
     * Display the user detail.
     */
    public function detail_pengguna($user): View
    {
        $active = 'daftar-pengguna';
        
        $data = User::find($user);
        //brands applied by user
        $brands = Brand::where('id_user', $user)->orderby('updated_at', 'desc')->get();

        return view('admin.detail-pengguna', compact('active', 'data', 'brands'));
    }

    /**
     * Delete user account.
     */
    public function destroy(Request $request, $user): RedirectResponse
    {   
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user_delete = User::find($user);
        $user_delete->delete();

        $msg = "User Deleted!";
        Alert::success($msg);

        return Redirect::route('admin.daftar-pengguna.index');
    }

    /**
     * Grant admin role to user
     */
    public function grant_admin_role(Request $request): RedirectResponse
    {
        if ($request->user()->hasRole('admin'))
        {
            $data = User::find($request->id_user);
            if(!$data->hasRole('admin'))
            {
                $data->assignRole('admin');
            }
    
            $msg = "Role Granted!";
            Alert::success($msg);
    
            return Redirect::route('admin.daftar-pengguna.index');
        } else {
            $msg = "Cannot Grant User!";
            Alert::error($msg);
    
            return Redirect::route('admin.daftar-pengguna.index');
        }
    }
}
