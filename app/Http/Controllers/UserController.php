<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get all users
    public function index()
    {
        return response()->json(['users' => User::all()->except(Auth::user()->id)]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:125'],
            'last_name' => ['required', 'string', 'max:125'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ],
        [
            'error_code' => 422,
            'error_title' => 'User create failure',
            'error_message' => 'The :attribute field is required.'           
        ]);
    }

    // Get a single user
    public function show($user_id)
    {
        return response()->json(['user' => User::findOrFail($user_id)]);
    }

     /**
     * Update a single user
     * @param  object  $request
     * @param int $user_id - unique user identifier
     * @return json
     */ 
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update($request->only(['first_name', 'last_name', 'email']));

        return response()->json(['user' => $user]);
    }

    // Delete a user
    public function destroy($user_id)
    {
        User::findOrFail($user_id)->delete();
        return response()->json(['message' => "User {$user_id} deleted successfully"]);
    }
}