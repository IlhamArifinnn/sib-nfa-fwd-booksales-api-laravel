<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role', 'created_at')->get();

        if ($users->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "No users found",
                'data' => []
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "List of Users",
            'data' => $users
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = User::select('id', 'name', 'email', 'role', 'created_at')->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'User details',
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'role' => 'sometimes|required|in:customer,admin',
            ]);

            $user->update($validated);

            $user = $user->select('id', 'name', 'email', 'role', 'created_at')->first();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent deleting the last admin
            if ($user->role === 'admin') {
                $adminCount = User::where('role', 'admin')->count();
                if ($adminCount <= 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot delete the last admin user',
                        'data' => null
                    ], 400);
                }
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
                'data' => null
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }
    }
}
