<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Ambil data kelas sekalian ngitung jumlah siswa di masing-masing kelas
        $kelas = Kelas::withCount('siswas')->latest()->get();
        
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form kelas
        $validatedData = $request->validate([
            'nama_kelas'   => 'required|string|max:255',
            'tingkat'      => 'required|string|max:50',
            'jurusan'      => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        // Simpan ke database
        Kelas::create($validatedData);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambah!');
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        // Validasi inputan pas update
        $validatedData = $request->validate([
            'nama_kelas'   => 'required|string|max:255',
            'tingkat'      => 'required|string|max:50',
            'jurusan'      => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        // Update datanya
        $kela->update($validatedData);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diupdate!');
    }

    public function destroy(Kelas $kela)
    {
        // Hapus data kelas
        $kela->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus!');
    }
}