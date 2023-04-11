<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\AuthToken;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        try {
            $token = AuthToken::where('name', '=', 'user_token');
            if ($token) {
                $categories = Categories::all();
                return response()->json($categories, 200);
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $token = AuthToken::where('name', '=', 'admin_token');
            if ($token) {
                $request->validate([
                    'name' => 'required|string',
                    'description' => 'required'
                ]);
        
                $categorie = new Categories();
                $categorie->name = $request->name;
                $categorie->description = $request->description;
                $categorie->save();
        
                return response()->json(['Message' => 'create success'], 201);
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'Message' => 'Data cannot be processed'
            ], 422);       
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {   
            $token = AuthToken::where('name', '=', 'user_token');
            if ($token) {
                $category = Categories::where('id', '=', $id)->first();
                return response()->json($category, 200);
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
