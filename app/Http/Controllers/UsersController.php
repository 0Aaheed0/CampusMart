<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->userService->getUsers();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([
            'data' => [
                'id' => $id,
                'name' => 'Item ' . $id,
                'description' => 'Description for item ' . $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $body = $request->json();

        // Log to console/logs instead of response
        logger()->info('POST /items - Request body:', ['body' => $body]);
        logger()->info('POST /items - All request data:', $request->all());

        return response()->json([
            'message' => 'Item created successfully',
            'data' => [
                'id' => rand(100, 999),
                'name' => $body->get('name'),
                'description' => $request->input('description', 'Item description'),
                'created_at' => now(),
            ]
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Item updated successfully',
            'data' => [
                'id' => $id,
                'name' => $request->input('name', 'Updated Item'),
                'description' => $request->input('description', 'Updated description'),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Partially update the specified resource in storage.
     */
    public function patch(Request $request, $id)
    {
        return response()->json([
            'message' => 'Item partially updated successfully',
            'data' => [
                'id' => $id,
                'name' => $request->input('name', 'Partially Updated Item'),
                'description' => $request->input('description', 'Partially updated description'),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json([
            'message' => 'Item deleted successfully',
            'data' => [
                'id' => $id,
            ]
        ]);
    }

    /**
     * Get user profile data for popup display
     */
    public function popup($id)
    {
        $user = \App\Models\User::with('profile')->findOrFail($id);

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? 'Not provided',
                'department' => $user->profile?->department ?? 'Not specified',
                'year' => $user->profile?->year ?? 'Not specified',
                'semester' => $user->profile?->semester ?? 'Not specified',
                'student_id' => $user->profile?->student_id ?? 'Not specified',
                'batch' => $user->profile?->batch ?? 'Not specified',
                'gender' => $user->profile?->gender ?? 'Not specified',
                'products_posted' => $user->products()->count(),
                'products_sold' => $user->soldItems()->count(),
            ]
        ]);
    }
}