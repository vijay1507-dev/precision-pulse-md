<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveAdminRequest;
use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminProfileController extends Controller
{

    public function index(Request $request)
    {

        $admin = Admin::fetchWithUser($request->user()->id);    

        if (!$admin) {
     
            return redirect()->route('admin.profile',['id' => auth()->id()])
            ->with('warning', 'Please complete your admin profile.');
        }

        return view('admin.dashboard', ['admin' => $admin ]);
    }


    public function save(SaveAdminRequest $request, $id=null)
    {
        $data = $request->validated();

        $admin = $id ? Admin::findOrFail($id) : new Admin();

        $admin->saveProfile($data, $request);

        return redirect()
        ->route('admin.profile')
        ->with('success', $id ? 'Profile updated successfully.' : 'Profile created successfully.');
    }

   
    public function viewSelf()
    {
        $admin = Admin::fetchWithUser(auth()->id());

        return view('admin.profile.view', ['admin' => $admin]);
    }
}
