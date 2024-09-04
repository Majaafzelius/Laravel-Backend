<?php

namespace App\Http\Controllers;

use App\Models\accessories;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return accessories::all();
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
            'type' => 'required',
            'amount' => 'required'
        ]);

        return accessories::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $accessories = accessories::find($id);

        if ($accessories != null) {
            return $accessories;
        } else {
            return response() -> json([
                'Accessoar ej hittad'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $accessories = accessories::find($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required', 
            'price' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);

        if ($accessories != null) {
            $accessories->update($request->all());
            return response()->json([
                'Accessoar uppdaterad till', $accessories
            ], 200);
        } else {
            return response()->json([
                'Accessoar ej hittad'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $accessories = accessories::find($id);

        if ($accessories != null) {
            $accessories->delete();
            return response()->json(['Accessoar borttaget ur lagret']);
        } else {
            return response() -> json([
                'Accessoar ej hittad'
            ], 404);
        }
    }
}
