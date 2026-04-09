<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
//use App\Models\Productos;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario'   => 'required|string|max:500',
        ]);

        Review::create([
            'id_producto'   => $id,
            'calificacion'  => $request->calificacion,
            'comentario'    => $request->comentario,
        ]);

        return redirect("/productos/{$id}")->with('success', 'Reseña publicada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
