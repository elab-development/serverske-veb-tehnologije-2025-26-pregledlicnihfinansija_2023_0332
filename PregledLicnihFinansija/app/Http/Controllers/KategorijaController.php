<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategorijaController extends Controller
{
    
    public function index()
    {
        $kategorije = Cache::remember('kategorije', 3600, function () {
        return Kategorija::all()->toArray();
        });
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
        Cache::forget('kategorije');
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
        Cache::forget('kategorije');
        return response()->json($kategorija);
    }

    
    public function destroy(string $id)
    {
        $kategorija = Kategorija::findOrFail($id);
        $kategorija->delete();
        Cache::forget('kategorije');
        return response()->json(['poruka' => 'Kategorija je obrisana']);
    }
}
