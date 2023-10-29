<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
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
            $pengeluaran = Pengeluaran::where('tanggal', 'LIKE', "%$keyword%")
                ->orWhere('deskripsi', 'LIKE', "%$keyword%")
                ->orWhere('nominal', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pengeluaran = Pengeluaran::latest()->paginate($perPage);
        }

        return view('pengeluaran.index', compact('pengeluaran'));
    }

    public function create()
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Pengeluaran::create($requestData);

        return redirect('pengeluaran')->with('flash_message', 'pengeluaran added!');
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return view('pengeluaran.show', compact('pengeluaran'));
    }

    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($requestData);

        return redirect('pengeluaran')->with('flash_message', 'pengeluaran updated!');
    }

    public function destroy($id)
    {
        Pengeluaran::destroy($id);

        return redirect('pengeluaran')->with('flash_message', 'pengeluaran deleted!');
    }
}
