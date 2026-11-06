@extends('layouts.main')

@section('title', 'Tambah Data Kelas')

@section('content')
    <div class="container-fluid">
        <form action="{{route('kelas.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="{{ old('nama_kelas')}}">
            </div>
            <div class="mb-3">
                <label for="tingkat" class="form-label">tingkat</label>
                <input type="text" name="tingkat" id="tingkat" class="form-control" value="{{ old('tingkat')}}">
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">jurusan</label>
                <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan')}}">
            </div>
            <div class="mb-3">
                <label for="tahun_ajaran" class="form-label">tahun ajaran</label>
                <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran')}}">
            </div>
            <button type="submit" class="btn btn-primary">simpan</button>
            <a href="{{route('kelas.index')}}" class="btn btn-secondary">batal</a>
        </form>
    </div>
@endsection