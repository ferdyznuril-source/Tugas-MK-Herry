@extends('layouts.main')

@section('title', 'Edit Data Kelas')

@section('content')
    <div class="container-fluid">
       <div class="container-fluid">
       @if ($errors->any())
       <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
       </div>
       @endif
       <form action="{{route('kelas.update', $kela->id)}}" method="POST">
        @csrf
        @method ('PUT')
        <div class="mb-3">
            <label for="nama_kelas" class="form-label">nama kelas</label>
            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="{{old ('nama_kelas', $kela->nama_kelas)}}">
        </div>
        <div class="mb-3">
            <label for="tingkat" class="form-label">tingkat</label>
            <input type="text" name="tingkat" id="tingkat" class="form-control" value="{{old ('nama_kelas', $kela->nama_kelas)}}">
        </div>
        <div class="mb-3">
            <label for="jurusan" class="form-label">jurusan</label>
            <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{old ('jurusan', $kela->jurusan)}}"> 
        </div>
        <div class="mb-3">
            <label for="tahun_ajaran" class="form-label">tahun ajaran</label>
            <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="{{old ('tahun_ajaran', $kela->tahun_ajaran)}}">
        </div>
        <div class="mb-3">
            <label for="jumlah_siswa" class="form-label">jumlah siswa</label>
            <input type="text" name="jumlah_siswa" id="jumlah_siswa" value="{{old ('jumlah_siswa', $kela->jumlah_siswa)}}">
        </div>
        <button type="submit" class="btn btn-primary">simpan</button>
        <a href="{{route ('kelas.index')}}" class="btn btn-secondary">batal</a>
       </form>
    </div>
@endsection