@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('kaprodi.kelas.create') }}" class="btn btn-primary">Tambah</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID Kelas</th>
                <th scope="col">Nama</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{ $i = 1 }}
            @foreach ($kelas as $d)
            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $d->id }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->kapasitas }}</td>
                <td>
                    <a href="{{ route('kaprodi.kelas.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    {{-- <a href="{{ route('kaprodi.dosen.destroy', $d->id) }}" class="btn btn-danger btn-sm">Hapus</a> --}}

                    <form action="{{ route('kaprodi.kelas.destroy', $d->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
