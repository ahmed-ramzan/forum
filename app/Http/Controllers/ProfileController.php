<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('profile.create',compact('user'));
    }

    public function update(User $user,Request $request)
    {
        $path = $request->image->store('profiles');
        $user->image = $path;
        $user->save();
        return redirect(route('profile.edit'))->with('success','Profile updated successfully');
    }
}
