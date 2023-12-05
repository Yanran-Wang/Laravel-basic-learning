<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
 
class profileController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = new User();
        $user->name = "Jane Doe";
        $user->id = $id;

        return view('profile', [
            'user' => $user
        ]);
    }
}