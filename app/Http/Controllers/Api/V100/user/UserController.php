<?php

namespace App\Http\Controllers\Api\V100\user;

use App\User;
use Illuminate\Http\Request;
use App\Events\UserBroadcast;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
        ];
        $this->validate($request, $rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('qwerty'),
        ]);

        /** Created User Broadcast Event */
        try {
            event(new UserBroadcast($user));
        } catch (\Exception $e) {
            /** Do Nothing */
        }

        return ["data" => $user];
    }
}
