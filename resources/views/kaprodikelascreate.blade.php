@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('kaprodi.kelas.store') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="form-group">
                <label for="kapasita">Kapasitas</label>
                <input type="text" class="form-control" id="kapasitas" name="kapasitas">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
