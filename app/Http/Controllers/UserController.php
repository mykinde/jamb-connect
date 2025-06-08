<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::query();

    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%$search%")
              ->orWhere('email', 'LIKE', "%$search%")
              ->orWhere('city', 'LIKE', "%$search%");
        });
    }

    $users = $query->latest()->paginate(10)->withQueryString();

    return view('users.index', compact('users', 'search'));
}


// app/Http/Controllers/UserController.php
public function show(User $user)
{
    return view('users.show', compact('user'));
}


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'phone'    => 'required|string|max:20',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'company'  => 'nullable|string|max:100',
            'city'     => 'nullable|string|max:100',
            'address'  => 'nullable|string',
            'role'     => 'required|in:admin,user',
        ]);

        User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'company'  => $request->company,
            'city'     => $request->city,
            'address'  => $request->address,
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'phone'    => 'required|string|max:20',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'company'  => 'nullable|string|max:100',
            'city'     => 'nullable|string|max:100',
            'address'  => 'nullable|string',
            'role'     => 'required|in:admin,user',
        ]);

        $user->update($request->except('password') + [
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
