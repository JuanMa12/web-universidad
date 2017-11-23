<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class UserController extends Controller
{
    public function index()
    {
        return response()
            ->json([
                'list' => User::all()
            ]);
    }


    public function store(RegisterUserRequest $request)
    {
        User::create([
            'uuid' => Uuid::generate(4),
            'name'   => $request->name,
            'email'   => $request->email,
            'password'   => bcrypt($request->password)
        ]);

        return response()->json(['saved' => true]);
    }

    public function show($id)
    {
        $auth = User::byUuid($id);
        return response()
            ->json([
                'model' => $auth
            ]);
    }


    public function edit($id)
    {
        $auth = User::byUuid($id);
        return response()
            ->json([
                'form' => $auth
            ]);
    }

    public function update(Request $request , $id)
    {
        $this->validate($request, [
            'phone' => 'max:10',
        ]);
        $user = User::byUuid($id);
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->phone   = $request->phone;
        if($request->avatar == $user->avatar) {}else{$user->avatar = $request->avatar;}
        $user->save();
        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function destroy($id)
    {
        $auth = User::byUuid($id);
        $auth->delete();
        return response()
            ->json([
                'deleted' => true
            ]);
    }

}
