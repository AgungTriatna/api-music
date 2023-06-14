<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    //

    public function index(){
        $data['user'] = User::get();
        return view('management-user.index',$data);
    }

    public function create(){
        return view('management-user.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'users_name'   => 'required',
            'users_email'   => 'required',
            'users_role'   => 'required',
            'users_password'   => 'required',
         
        ]);

        $user = new User();
        $user->users_name = $validateData['users_name'];
        $user->users_email = $validateData['users_email'];
        $user->users_role = $validateData['users_role'];
       
        $user->users_password = Hash::make($validateData['users_password']);
        $user->save();

        return redirect()->route('management/user')->with(['success' => 'User added successfully!']);
    }

    public function edit($id){
        $data['user'] = User::find($id);
        return view('management-user.edit',$data);
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'users_name'   => 'required',
            'users_email'   => 'required',
            'users_role'   => 'required',
        ]);

        $user = User::find($id);
        $user->users_name = $validateData['users_name'];
        $user->users_email = $validateData['users_email'];
        $user->users_role = $validateData['users_role'];
        $user->save();

        return redirect()->route('management/user')->with(['success' => 'User edited successfully!']);
    }
    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();

        return redirect()->route('management/user')->with(['success' => 'User deleted successfully!']);
    }
}
