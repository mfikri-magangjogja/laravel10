@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ini halaman dashoard kaprodi</h1>
    <a href="{{ route('kaprodi.dosen.index') }}">Dosen</a>
    <a>Kelas</a>
</div>
@endsection