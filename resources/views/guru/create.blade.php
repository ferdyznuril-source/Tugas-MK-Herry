@extends('layouts.main')

@section('title', 'Tambah Data Guru')

@section('content')
    <div class="container-fluid">
        <form action="{{route('guru.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip')}}">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama')}}">
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                    <option value="">-- pilih --</option>
                    <option value="L" {{old ('jenis_kelamin') == 'L' ? 'selected' : ''}}>laki laki</option>
                    <option value="P" {{old ('jenis_kelamin') == 'P' ? 'selected' : ''}}>perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email')}}">
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No hp</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp')}}">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat')}}">
            </div>
            <button type="submit" class="btn btn-primary">simpan</button>
            <a href="{{route('guru.index') }}" class="btn btn-secondary">batal</a>
        </form>
    </div>
@endsection