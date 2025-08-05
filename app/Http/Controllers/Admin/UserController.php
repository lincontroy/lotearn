<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function addBalance(Request $request, User $user)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        $user->balance += $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Balance added successfully.');
    }
}
