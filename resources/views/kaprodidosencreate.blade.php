@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('kaprodi.dosen.store') }}">
            @csrf
            <div class="form-group">
                <label for="id_user">User ID</label>
                <select class="form-select" aria-label="Default select example" name="id_user" id="id_user">
                    <option selected>Pilih ID User</option>
                    @foreach ($user as $d)
                        <option value="{{ $d->id }}">{{ $d->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_dosen">Kode Dosen</label>
                <input type="text" class="form-control" id="kode_dosen" name="kode_dosen">
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
