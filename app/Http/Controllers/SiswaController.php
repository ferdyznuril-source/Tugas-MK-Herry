<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data siswa, sekalian panggil relasi kelasnya (eager loading) biar gak berat query-nya
        $siswas = Siswa::with('kelas')->latest()->get();
        
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        // Ambil data kelas buat dijadiin pilihan di dropdown form
        $kelas = Kelas::all();
        
        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'nis'           => 'required|string|unique:siswas,nis|max:20', // NIS gak boleh dobel
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'kelas_id'      => 'required|exists:kelas,id', // Pastiin kelasnya beneran ada di tabel kelas
        ]);

        // Simpan ke database
        Siswa::create($validatedData);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambah!');
    }

    public function show(Siswa $siswa)
    {
        // Load relasi kelas sama relasi nilai (sekalian mapel-nya) buat ditampilin di halaman detail
        // Asumsi gue lu udah bikin relasi 'nilais' di model Siswa.php ya
        $siswa->load(['kelas', 'nilais.mapel']);
        
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        // Ambil data kelas buat dropdown pas mau ngedit
        $kelas = Kelas::all();
        
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        // Validasi lagi, NIS dikasih pengecualian buat ID siswa ini biar gak error pas disave
        $validatedData = $request->validate([
            'nis'           => 'required|string|max:20|unique:siswas,nis,' . $siswa->id,
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'kelas_id'      => 'required|exists:kelas,id',
        ]);

        // Update datanya
        $siswa->update($validatedData);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy(Siswa $siswa)
    {
        // Hapus data
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}