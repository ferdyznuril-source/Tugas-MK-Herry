@extends('layouts.main')

@section('title', 'Edit Data Guru')

@section('content')
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
       <form action="{{route('guru.update', $guru->id)}}" method="POST">
        @csrf
        @method ('PUT')
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" id="nip" class="form-control" value="{{old ('nip', $guru->nip)}}">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{old ('nama', $guru->nama)}}">
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                <option value="">--pilih--</option>
                <option value="L" {{old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ?  'selected' : ''}}>Laki-Laki</option>
                <option value="P" {{old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ?  'selected' : ''}}>perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{old ('email', $guru->email)}}">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No Hp</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{old ('no_hp', $guru->no_hp)}}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{old ('alamat', $guru->alamat)}}">
        </div>
        <button type="submit" class="btn btn-primary">simpan</button>
        <a href="{{route('guru.index')}}" class="btn btn-secondary">batal</a>
       </form>
    </div>
@endsection