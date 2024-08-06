<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index(Request $request)
    {
        // $id = $request->user_id; 
        // $kaprodi = Kaprodi::find($id); 
        // if (!$kaprodi) {
        //      return redirect()->back()->with('error', 'Kaprodi tidak ditemukan.');
        // }

        return view('kaprodiindex');
    }
    public function editKaprodi(Kaprodi $kaprodi)
    {
        return view('kaprodi.edit');
    }

    public function updateKapordi(Request $request, Kaprodi $kaprodi)
    {
        $request->validate([
            'kode_dosen' => 'required|integer',
            'nip' => 'required|integer',
            'nama' => 'required|string|max:100',
        ]);

        $kaprodi->update($request->all());

        return redirect()->route('kaprodi.index')->with('success', 'Kaprodi berhasil diperbarui.');
    }







    public function indexdosen()
    {
        $dosen = dosen::get();
        return view('kaprodidosenindex', compact('dosen'));
    }


    public function createDosen()
    {
        $user = User::select('id')->where('role', 'dosen')->get();
        return view('kaprodidosencreate', compact('user'));
    }


    public function storeDosen(Request $request)
    {

        Dosen::create([
            'id_user' => $request->input('id_user'),
            'kode_dosen' => $request->input('kode_dosen'),
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
        ]);


        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil ditambah.');
    }

    public function editDosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('kaprodidosenedit', compact('dosen'));
    }



    public function updateDosen(Request $request, $id)
{
    $request->validate([
        'kode_dosen' => 'required|integer',
        'nip' => 'required|integer',
        'nama' => 'required|string|max:100',
    ]);

    $dosen = Dosen::findOrFail($id);
    $dosen->update($request->all());

    return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil diperbarui.');
}


    public function destroyDosen(Dosen $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }


    public function indexKelas()
    {
        $kelas = Kelas::all();
        return view('kaprodikelasindex', compact('kelas'));
    }

    public function createKelas()
    {
        return view('kaprodikelascreate');
    }

    public function storeKelas(Request $request)
    {
        Kelas::create([
            'nama' => $request->input('nama'),
            'kapasitas' => $request->input('kapasitas'),
           
        ]);

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function editKelas($id)
{
    $kelas = Kelas::findOrFail($id);
    return view('kaprodikelasedit', compact('kelas'));
}

public function updateKelas(Request $request, $id)
{
    $kelas = Kelas::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:50',
        'kapasitas' => 'required|integer|min:1',
    ]);

    $kelas->update($request->only(['nama', 'kapasitas']));

    return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
}

public function destroyKelas($id)
{
    $kelas = Kelas::findOrFail($id);
    $kelas->delete();

    return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil dihapus.');
}












    // Ploting Mahasiswa dan Dosen ke dalam Kelas
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

        // Check if class capacity is exceeded
        if ($kelas->mahasiswas()->count() >= $kelas->kapasitas) {
            return redirect()->route('kaprodi.ploting.index')->with('error', 'Kapasitas kelas sudah penuh.');
        }

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
