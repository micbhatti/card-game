<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ScoresBoard;

class UserController extends Controller
{
    /**
     * Store or find user from database
     *
     * @param Request $request
     * @return json
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $user = User::firstOrCreate(['name' => $request->name]);

        session([
            'user_id' => $user->id
        ]);

        return response()->json(['user_id' => session()->get('user_id')], 200);

    }

}
