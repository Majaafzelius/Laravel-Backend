<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use Illuminate\Http\Request;

class ClothingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Clothes::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required', 
            'price' => 'required',
            'colour' => 'required',
            'amount' => 'required'
        ]);

        return Clothes::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clothing = Clothes::find($id);
        if ($clothing != null ) {
            return $clothing;
        } else {
            return response() -> json([
                'Klädesplagg ej hittad'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $clothing = Clothes::find($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required', 
            'price' => 'required',
            'colour' => 'required',
            'amount' => 'required'
        ]);

        if ($clothing != null) {
            $clothing->update($request->all());
            return response()->json([
                'Klädesplagg uppdaterad till', $clothing
            ], 200);
        } else {
            return response()->json([
                'klädesplagg ej hittad'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clothing = Clothes::find($id);

        if ($clothing != null) {
            $clothing->delete();
            return response()->json(['klädesplagg borttaget ur lagret']);
        } else {
            return response()->json([
                'klädesplagg ej hittad'
            ], 404);
        }
    }
}
