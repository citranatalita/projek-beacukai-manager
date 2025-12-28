<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function profile() {
        return view('admin.profile.index');
    }
    
    public function edit() {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update basic info
        $user->name = $request->name;
        $user->phone = $request->phone;

        // Upload Foto
        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if ($user->photo && file_exists(public_path('uploads/profile/' . $user->photo))) {
                unlink(public_path('uploads/profile/' . $user->photo));
            }

            // Upload baru
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            $user->photo = $filename;
        }

        $user->save();

        return redirect()->route('admin.profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}