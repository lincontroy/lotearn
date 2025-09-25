<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    $users = User::when(request('search'), function($query) {
        $query->where('name', 'like', '%'.request('search').'%')
              ->orWhere('email', 'like', '%'.request('search').'%')
              ->orWhere('phone', 'like', '%'.request('search').'%');
    })->paginate(10);

    return view('admin.users', compact('users'));
}

    public function addBalance(Request $request, User $user)
    {
        dd($request, $user);
        $request->validate(['amount' => 'required|numeric|min:1']);
        $user->wallet_balance += $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Balance added successfully.');
    }

    public function deductBalance(Request $request, User $user)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        $user->wallet_balance -= $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Balance added successfully.');
    }
}
