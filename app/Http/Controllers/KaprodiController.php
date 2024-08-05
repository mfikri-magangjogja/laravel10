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
        return view('kaprodiindex', compact('dosen'));
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

    
    public function plotingIndex()
    {
        $kelas = Kelas::with(['mahasiswas', 'dosens'])->get();
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('kaprodi.ploting.index', compact('kelas', 'mahasiswas', 'dosens'));
    }

    public function plotMahasiswa(Request $request, Kelas $kelas)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:t_mahasiswa,mahasiswa_id',
        ]);

        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);
        $mahasiswa->kelas_id = $kelas->kelas_id;
        $mahasiswa->save();

        return redirect()->route('kaprodi.ploting.index')->with('success', 'Mahasiswa berhasil dipotting ke kelas.');
    }

    public function plotDosen(Request $request, Kelas $kelas)
    {
        $request->validate([
            'dosen_id' => 'required|exists:t_dosen,dosen_id',
        ]);

        $dosen = Dosen::find($request->dosen_id);
        $dosen->kelas_id = $kelas->kelas_id;
        $dosen->save();

        return redirect()->route('kaprodi.ploting.index')->with('success', 'Dosen berhasil dipotting ke kelas.');
    }

    public function unplotMahasiswa(Kelas $kelas, Mahasiswa $mahasiswa)
    {
        $mahasiswa->kelas_id = null;
        $mahasiswa->save();

        return redirect()->route('kaprodi.ploting.index')->with('success', 'Mahasiswa berhasil dihapus dari kelas.');
    }

    public function unplotDosen(Kelas $kelas, Dosen $dosen)
    {
        $dosen->kelas_id = null;
        $dosen->save();

        return redirect()->route('kaprodi.ploting.index')->with('success', 'Dosen berhasil dihapus dari kelas.');
    }
}
