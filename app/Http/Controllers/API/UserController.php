<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    function index()
    {
        $user = UserResource::collection(User::all());
        $data = [
            "msg" => "Return all data",
            "status" => 200,
            "data" => $user
        ];
        return response()->json($data);
    }

    function showuser($id)
    {
        $user = User::find($id);
        if ($user) {
            $data = [
                "msg" => "Return one Record",
                "status" => 200,
                "data" => new UserResource($user)
            ];
            return response()->json($data);
        } else {
            $data = [
                "msg" => "No Such ID",
                "status" => 201,
                "data" => null
            ];
            return response()->json($data);
        }
    }

    function deleteuser(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $data = [
                "msg" => "Deleted successfully",
                "status" => 200,
                "data" => null
            ];
            return response()->json($data);
        } else {
            $data = [
                "msg" => "No Such ID",
                "status" => 201,
                "data" => null
            ];
            return response()->json($data);
        }
    }

    function storeuser(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pass' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                "msg" => "Validation Required",
                "status" => 201,
                "data" => $validator->errors()
            ];
            return response()->json($data);
        }
        $validatedData = $validator->validate();

        $newRecord = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($validatedData['pass']),
            'role' => $request->role,
            'status' => $request->status,
        ]);
        $data = [
            "msg" => "Created successfully",
            "status" => 200,
            "data" => new UserResource($newRecord)
        ];
        return response()->json($data);
    }

    function updateuser(Request $request)
    {
        $old_id = $request->old_id;
        $validatedData = validator($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($old_id)
            ],
            'role' => 'required',
            'status' => 'required',
        ]);

        if ($validatedData->fails()) {
            $data = [
                "msg" => "Validation Required",
                "status" => 201,
                "data" => $validatedData->errors()
            ];
            return response()->json($data);
        }

        // Find user
        $user = User::find($old_id);
        if ($user) {
            // Update user fields
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->role = $request['role'];
            $user->status = $request['status'];

            // Update password only if provided
            if (!empty($request['pass'])) {
                $user->password = Hash::make($request['pass']);
            }

            $user->save();
            $data = [
                "msg" => "Updated successfully",
                "status" => 200,
                "data" => new UserResource($user)
            ];
            return response()->json($data);
        } else {
            $data = [
                "msg" => "No such ID",
                "status" => 203,
                "data" => null
            ];
            return response()->json($data);
        }
    }
}
