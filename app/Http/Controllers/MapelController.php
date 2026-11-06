<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        // Ambil semua data mata pelajaran, urutin dari yang terbaru
        $mapels = Mapel::latest()->get();
        
        return view('mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel', // Kode mapel gak boleh dobel
            'nama_mapel' => 'required|string|max:255',
            'kkm'        => 'required|numeric|min:0|max:100', // KKM biasanya angka 0-100
        ]);

        // Simpan ke database
        Mapel::create($validatedData);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambah!');
    }

    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        // Validasi pas update, kode_mapel dikasih pengecualian buat ID mapel ini biar gak error "sudah terpakai"
        $validatedData = $request->validate([
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel,' . $mapel->id,
            'nama_mapel' => 'required|string|max:255',
            'kkm'        => 'required|numeric|min:0|max:100',
        ]);

        // Update datanya
        $mapel->update($validatedData);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diupdate!');
    }

    public function destroy(Mapel $mapel)
    {
        // Hapus data
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus!');
    }
}