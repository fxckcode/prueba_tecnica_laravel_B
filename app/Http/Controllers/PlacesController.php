<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\AuthToken;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $token = AuthToken::where('name', '=', 'user_token');
            if ($token) {
                $places = Places::all();
                return response()->json($places, 200);
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
                    'id' => 'required',
                    'name' => 'required',
                    'description' => 'required',
                    'address' => 'required',
                    'id_categories' => 'required'
                ]);
    
                $place = new Places();
                $place->name = $request->name;
                $place->description = $request->description;
                $place->address = $request->address;
                $place->id_categories = $request->id_categories;
                $place->save();
    
                return response()->json([
                    'message' => 'create success'
                ], 201);
            } else {

            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data cannot be processed'
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
                $places = Places::where('id', '=', $id)->get();
                return response()->json($places, 200);
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
        try {
            $token = AuthToken::where('name', '=', 'user_token');
            if ($token) {
                $request->validate([
                    'name' => 'required',
                    'description' => 'required',
                    'address' => 'required',
                    'id_categories' => 'required'
                ]);
        
                $place = Places::find($id);
                $place->name = $request->name;
                $place->description = $request->description;
                $place->address = $request->address;
                $place->id_categories = $request->id_categories;
                $place->save();
    
                return response()->json([
                    'message' => 'update success'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data cannot be updated'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $token = AuthToken::where('name', '=', 'admin_token');
            if ($token) {
                $place = Places::find($id);
                $place->delete();
        
                return response()->json([
                    'message' => 'delete success'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }   
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data cannot be deleted'
            ], 400);
        }
    }
}
