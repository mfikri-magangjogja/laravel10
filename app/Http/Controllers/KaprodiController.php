<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function indexDosen()
    {
        $dosen = Dosen::all();
        return view('kaprodi.dosen.index', compact('dosen'));
    }

    public function createDosen()
    {
        return view('kaprodi.dosen.create');
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id|unique:dosen,user_id',
            'nama' => 'required|string|max:100',
        ]);

        Dosen::create($request->all());

        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function editDosen(Dosen $dosen)
    {
        return view('kaprodi.dosen.edit', compact('dosen'));
    }

    public function updateDosen(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $dosen->update($request->all());

        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroyDosen(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }

    public function indexKelas()
    {
        $kelas = Kelas::all();
        return view('kaprodi.kelas.index', compact('kelas'));
    }

    public function createKelas()
    {
        return view('kaprodi.kelas.create');
    }

    public function storeKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function editKelas(Kelas $kelas)
    {
        return view('kaprodi.kelas.edit', compact('kelas'));
    }

    public function updateKelas(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $kelas->update($request->all());

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroyKelas(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }

    public function plotMahasiswaDosen(Request $request, Kelas $kelas)
    {
        $request->validate([
            'mahasiswa_ids' => 'array',
            'dosen_ids' => 'array',
        ]);

        $kelas->mahasiswa()->sync($request->input('mahasiswa_ids', []));

        $kelas->dosen()->sync($request->input('dosen_ids', []));

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Mahasiswa dan dosen berhasil dipetakan ke kelas.');
    }

}
