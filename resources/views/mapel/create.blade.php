@extends('layouts.main')

@section('title', 'Tambah Data Mata Pelajaran')

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
        <form action="{{route('mapel.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="kode_mapel" class="form-label">kode mapel</label>
                <input type="text" name="kode_mapel" id="kode_mapel" class="form-control" value="{{ old('kode_mapel')}}">
            </div>
             <div class="mb-3">
                <label for="nama_mapel" class="form-label">nama mapel</label>
                <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" value="{{ old('nama_mapel')}}">
            </div>
            <div class="mb-3">
                <label for="kkm" class="form-label">kkm</label>
                <input type="number" name="kkm" id="kkm" class="form-control" value="{{old('kkm')}}" min:"0" max:"100" >
            </div>
            <button type="submit" class="btn btn-primary">simpan</button>
            <a href="{{route('mapel.index')}}" class="btn btn-secondary">batal</a>
    </div>
@endsection