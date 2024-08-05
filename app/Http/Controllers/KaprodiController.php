<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('kaprodiindex');
    }

    public function createDosen()
    {
        return view('kaprodi.dosen.create');
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id|unique:t_dosen,id',
            'kelas_id' => 'required|exists:t_kelas,kelas_id',
            'kode_dosen' => 'required|integer',
            'nip' => 'required|integer',
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
            'kelas_id' => 'required|exists:t_kelas,kelas_id',
            'kode_dosen' => 'required|integer',
            'nip' => 'required|integer',
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
            'nama' => 'required|string|max:50',
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
            'nama' => 'required|string|max:50',
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

    public function showMahasiswa(Kelas $kelas)
    {
        $mahasiswa = $kelas->mahasiswa; 
        return view('kaprodi.mahasiswa.index', compact('mahasiswa', 'kelas'));
    }

    public function addMahasiswaToKelas(Request $request, Kelas $kelas)
    {
        $request->validate([
            'mahasiswa_ids' => 'required|array',
            'mahasiswa_ids.*' => 'exists:t_mahasiswa,mahasiswa_id',
        ]);

        $kelas->mahasiswa()->sync($request->mahasiswa_ids, false);

        return redirect()->route('kaprodi.showMahasiswa', $kelas->kelas_id)->with('success', 'Mahasiswa berhasil ditambahkan ke kelas.');
    }

}
