<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user) {
        $follows=auth()->user() ? auth()->user()->following->contains($user):false;
        $user=User::findOrFail($user);
        return view('profiles/index',[
            'user'=>$user,
            'follows'=>$follows,
        ]);
    }
    public function edit(User $user) {
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }
    public function update(User $user) {
        $this->authorize('update',$user->profile);
        $data = \request()->validate([
           'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'image'
        ]);

        if(\request('image')) {
            $imagePath=\request('image')->store('profile','public');
            $image=Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }

        if (isset($data['image'])) {
            auth()->user()->profile()->update([
                'title'=>$data['title'],
                'description'=>$data['description'],
                'url'=>$data['url'],
                'image'=>$imagePath,
            ]);
        }
        else {
            auth()->user()->profile()->update([
                'title'=>$data['title'],
                'description'=>$data['description'],
                'url'=>$data['url'],
            ]);
        }
        return redirect("/profile/{$user->id}");
    }
}
