<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
   public function index(){
    $users = User::paginate(5);

    return view('user.index',[
        'users' => $users,
        'title' => 'Lista de usuario do Sistema'
    ]);
   }

   public function show($id)
   {
    $user = User::find($id);
  
    return view('user.show',[
        'user' => $user]);

   }

   public function register()
   {
       return view('user.create');
   }

   public function store(Request $request)
   {
    $input = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    User::create($input);
    return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    
   }
   

}
