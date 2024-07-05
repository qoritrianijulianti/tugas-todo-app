<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.home', compact('users'));
    }

    public function edit($id)
    {
        if (Auth::id() != $id) {
            return redirect()->route('user.home')->with('error', 'You do not have permission to edit this user.');
        }

        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::id() != $id) {
            return redirect()->route('user.home')->with('error', 'You do not have permission to update this user.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.home')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        if (Auth::id() != $id) {
            return redirect()->route('user.home')->with('error', 'You do not have permission to delete this user.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'User deleted and logged out successfully.');
    }
}
