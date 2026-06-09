<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use Illuminate\Http\Request;

class KategorijaController extends Controller
{
    
    public function index()
    {
        $kategorije = Kategorija::all();
        return response()->json($kategorije);
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string',
            'tip' => 'required|in:prihod,trosak'
        ]);

        $kategorija = Kategorija::create($request->all());
        return response()->json($kategorija, 201);
    }

   
    public function show(string $id)
    {
        $kategorija = Kategorija::findOrFail($id);
        return response()->json($kategorija);
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        $kategorija = Kategorija::findOrFail($id);
        $kategorija->update($request->all());
        return response()->json($kategorija);
    }

    
    public function destroy(string $id)
    {
        $kategorija = Kategorija::findOrFail($id);
        $kategorija->delete();
        return response()->json(['poruka' => 'Kategorija je obrisana']);
    }
}
