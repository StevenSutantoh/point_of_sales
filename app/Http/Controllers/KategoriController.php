<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $kategori = Kategori::where('nama_kategori', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $kategori = Kategori::latest()->paginate($perPage);
        }

        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Kategori::create($requestData);

        return redirect('kategori')->with('flash_message', 'kategori added!');
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $kategori = Kategori::findOrFail($id);
        $kategori->update($requestData);

        return redirect('kategori')->with('flash_message', 'kategori updated!');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);

        return redirect('kategori')->with('flash_message', 'kategori deleted!');
    }
}