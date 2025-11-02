<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request) {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email'=> ['required','email','max:255'],
            'password' => ['nullable', Password::defaults()],
        ]);
        if (!empty($data['password'])) {
            $user->update([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>bcrypt($data['password']),
            ]);
        } else {
            unset($data['password']);
            $user->update($data);
        }
        return back()->with('success','Cập nhật hồ sơ thành công.');
    }

    public function destroy(Request $request) {
        $user = $request->user();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();
        return redirect('/')->with('success','Tài khoản đã được xoá.');
    }
}
