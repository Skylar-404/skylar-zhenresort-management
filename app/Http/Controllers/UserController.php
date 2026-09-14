<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of staff and system users.
     */
    public function index()
    {

        $totalUsers = User::count();

        $totalActiveUsers = User::where('is_active', 1)->count();

        $users = User::latest()->get();
        return view('admin.users', compact('users', 'totalUsers', 'totalActiveUsers'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'    => 'required|string|max:64|unique:user,username',
            'email'       => 'required|string|email|max:191|unique:user,email',
            'password'    => 'required|string|min:6|max:255',
            'full_name'   => 'required|string|max:160',
            'role'        => 'required|string|max:50',
            'permissions' => 'nullable|array',
            'is_active'   => 'required|boolean',
        ]);

        User::create([
            'username'      => $validated['username'],
            'email'         => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'full_name'     => $validated['full_name'],
            'role'          => $validated['role'],
            'permissions'   => $validated['permissions'] ?? null,
            'is_active'     => $validated['is_active'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username'    => ['required', 'string', 'max:64', Rule::unique('user', 'username')->ignore($user->id)],
            'email'       => ['required', 'string', 'email', 'max:191', Rule::unique('user', 'email')->ignore($user->id)],
            'password'    => 'nullable|string|min:6|max:255',
            'full_name'   => 'required|string|max:160',
            'role'        => 'required|string|max:50',
            'permissions' => 'nullable|array',
            'is_active'   => 'required|boolean',
        ]);

        $updateData = [
            'username'    => $validated['username'],
            'email'       => $validated['email'],
            'full_name'   => $validated['full_name'],
            'role'        => $validated['role'],
            'permissions' => $validated['permissions'] ?? null,
            'is_active'   => $validated['is_active'],
        ];

        // Update password only if a new one was provided
        if (!empty($validated['password'])) {
            $updateData['password_hash'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
