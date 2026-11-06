<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // Ambil semua data, urutin dari yang terbaru
        $gurus = Guru::latest()->get(); 
        
        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan dari form
        $validatedData = $request->validate([
            'nip'           => 'required|unique:gurus,nip', // Biar NIP gak ada yang dobel
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required', 
            'email'         => 'required|email|unique:gurus,email', // Email juga gak boleh sama
            'no_hp'         => 'required|string|max:20',
            'alamat'        => 'required|string',
        ]);

        // Simpan ke database
        Guru::create($validatedData);

        // Balik ke halaman index sambil bawa pesan sukses
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambah!');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        // Validasi lagi, tapi nip & email dikasih pengecualian buat ID guru ini
        // Biar kalo cuma ganti nama, nip & email-nya gak dibilang "sudah terpakai"
        $validatedData = $request->validate([
            'nip'           => 'required|unique:gurus,nip,' . $guru->id,
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'email'         => 'required|email|unique:gurus,email,' . $guru->id,
            'no_hp'         => 'required|string|max:20',
            'alamat'        => 'required|string',
        ]);

        // Update datanya
        $guru->update($validatedData);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diupdate!');
    }

    public function destroy(Guru $guru)
    {
        // Hapus data
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
    }
}