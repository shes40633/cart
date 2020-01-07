<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class accountController extends Controller
{
    public function index()
    {
        $items = User::all();

        return view('admin.account.index',compact('items'));
    }
    public function create()
    {
        return view('admin.account.create');
    }
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create_account($request->all());

        return redirect("/admin/account");
    }


    public function destroy(Request $request, $id)
    {

    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' =>['required','string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create_account(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
