<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        // Ambil data nilai, panggil relasi siswa (dan kelasnya) sama mapel biar query-nya efisien (eager loading)
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->latest()->get();
        
        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        // Ambil data siswa sama mapel buat ditampilin di dropdown form
        $siswas = Siswa::all();
        $mapels = Mapel::all();
        
        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'siswa_id'    => 'required|exists:siswas,id',
            'mapel_id'    => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts'   => 'required|numeric|min:0|max:100',
            'nilai_uas'   => 'required|numeric|min:0|max:100',
        ]);

        // Ambil data mapel buat ngecek KKM-nya
        $mapel = Mapel::findOrFail($validatedData['mapel_id']);

        // Itung nilai akhir: (tugas 30%) + (uts 30%) + (uas 40%)
        $nilai_akhir = ($validatedData['nilai_tugas'] * 0.3) + ($validatedData['nilai_uts'] * 0.3) + ($validatedData['nilai_uas'] * 0.4);
        
        // Tentuian keterangan lulus/enggak dari KKM
        $keterangan = $nilai_akhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        // Masukin hasil hitungan ke dalem array $validatedData biar sekalian disimpen
        $validatedData['nilai_akhir'] = $nilai_akhir;
        $validatedData['keterangan']  = $keterangan;

        // Simpan ke database
        Nilai::create($validatedData);

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambah!');
    }

    public function edit(Nilai $nilai)
    {
        // Ambil data siswa sama mapel buat dropdown lagi
        $siswas = Siswa::all();
        $mapels = Mapel::all();
        
        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        // Validasi inputan pas update
        $validatedData = $request->validate([
            'siswa_id'    => 'required|exists:siswas,id',
            'mapel_id'    => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts'   => 'required|numeric|min:0|max:100',
            'nilai_uas'   => 'required|numeric|min:0|max:100',
        ]);

        // Ambil data mapel lagi buat ngecek KKM
        $mapel = Mapel::findOrFail($validatedData['mapel_id']);

        // Itung ulang nilai akhirnya kalo-kalo ada nilai yang diganti
        $nilai_akhir = ($validatedData['nilai_tugas'] * 0.3) + ($validatedData['nilai_uts'] * 0.3) + ($validatedData['nilai_uas'] * 0.4);
        $keterangan = $nilai_akhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        // Timpa data barunya
        $validatedData['nilai_akhir'] = $nilai_akhir;
        $validatedData['keterangan']  = $keterangan;

        // Update datanya
        $nilai->update($validatedData);

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diupdate!');
    }

    public function destroy(Nilai $nilai)
    {
        // Hapus data
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus!');
    }
}