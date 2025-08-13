<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\UserRequest;
use App\Models\User;


class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $response = User::create($data);

        return response()->json($response);
    }

    public function show(string $id)
    {
      $user = User::where('id','>',10)->get()->retryCache();
//      $user = User::find(88)->deleteCache();
//      $user = User::driver('database')->find(88);
//      $user = User::driver('database')->find(88);

//        $user = User::where('id','>',10)->get();

        return response()->json($user);
    }

    public function update(UserRequest $request, string $id)
    {
        $data = $request->validated();
        $user = User::find($id);

        $response = $user->update($data);

        return response()->json($response);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $response = $user->delete();

        return response()->json($response);
    }
}
