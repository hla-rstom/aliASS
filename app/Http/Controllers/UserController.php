<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller

{
    public function brand_form(){
        return view('auth.register_bo');
    }

    public function brand_form_store(Request $request){

        $validate = $request->validate([
            'name'=> 'required|string',
            'email'=>'required|email',
            'role'=>'required',
            'password'=>'required|string|min:8',
            'password_confirmation'=>'required|same:password',
        ]);

        $brandOwner = new User();
        $brandOwner->name = $request->name;
        $brandOwner->email = $request->email;
        $brandOwner->role = $request->role;
        $brandOwner->password = bcrypt($request->password);
        $brandOwner->save();

        return redirect()->back()->with('success','Brand Owner Registered Successfully');
    }

    public function store_form(){
        return view('auth.register_so');
      }

        public function store_form_store(Request $request){

            $validate = $request->validate([
                'name'=> 'required|string',
                'email'=>'required|email|unique:users',
                'role'=>'required',
                'password'=>'required|string|min:8',
                'password_confirmation'=>'required|same:password',
            ]);

            $storeOwner = new User();
            $storeOwner->name = $request->name;
            $storeOwner->email = $request->email;
            $storeOwner->role = $request->role;
            $storeOwner->password = bcrypt($request->password);
            $storeOwner->save();

            return redirect()->back()->with('success','Store Owner Registered Successfully');
        }
}
