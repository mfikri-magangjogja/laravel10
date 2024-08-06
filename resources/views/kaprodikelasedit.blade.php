@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('kaprodi.kelas.update', $kelas->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kelas_id">ID Kelas</label>
            <input type="text" class="form-control" id="kelas_id" name="kelas_id" value="{{ $kelas->id }}" readonly>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $kelas->nama }}">
        </div>
        <div class="form-group">
            <label for="kapasitas">Kapasitas</label>
            <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="{{ $kelas->kapasitas }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
