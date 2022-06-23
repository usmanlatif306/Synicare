<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ImageUpload;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return auth()->user()->role_id == 1 ? view('admin.dashboard') : view('user.dashboard');
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        // dd(auth()->user()->image);
        // dd(auth()->user());
        return view('user.profile');
    }

    /**
     * Update Profile 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
        ]);
        auth()->user()->update($request->all());
        return redirect()->back()->with('success', 'User Profile Updated Successfully');
    }
    /**
     * Update Profile Image
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profileImage(Request $request)
    {
        $this->validate($request, [
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $image = $this->UserImageUpload($request->image, auth()->user()->image);
        auth()->user()->update(['image' => $image]);

        return redirect()->back()->with('image', 'User Profile Image Updated Successfully');
    }

    /**
     * Update Password
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Password(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if (Auth::attempt(['email' => auth()->user()->email, 'password' => $request->old_password])) {
            $password = Hash::make($request->password);
            auth()->user()->update(['password' => $password]);
            return redirect()->back()->with('password', 'Password Successfully Updated');
        }
        return redirect()->back()->with('error', 'Invalid Old Password');
    }
}
