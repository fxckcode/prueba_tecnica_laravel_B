<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        // Falta declarar si está autorizado o no
        $categories = Categories::all();

        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Falta declarar si está autorizado o no
        try {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required'
            ]);
    
            $categorie = new Categories();
            $categorie->name = $request->name;
            $categorie->description = $request->description;
            $categorie->save();
    
            return response()->json(['message' => 'Create success'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data cannot be processed']);       
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Falta declarar si está autorizado o no
        $categorie = Categories::where('id', '=', $id)->get();
        return response()->json($categorie, 200);
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
