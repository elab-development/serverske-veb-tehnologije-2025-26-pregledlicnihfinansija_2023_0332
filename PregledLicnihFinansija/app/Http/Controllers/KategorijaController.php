<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use Illuminate\Http\Request;

class KategorijaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategorije = Kategorija::all();
        return response()->json($kategorije);
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
    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string',
            'tip' => 'required|in:prihod,trosak'
        ]);

        $kategorija = Kategorija::create($request->all());
        return response()->json($kategorija, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategorija = Kategorija::findOrFail($id);
        return response()->json($kategorija);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategorija = Kategorija::findOrFail($id);
        $kategorija->update($request->all());
        return response()->json($kategorija);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategorija = Kategorija::findOrFail($id);
        $kategorija->delete();
        return response()->json(['poruka' => 'Kategorija je obrisana']);
    }
}
