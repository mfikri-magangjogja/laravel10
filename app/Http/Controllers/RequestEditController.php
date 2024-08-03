<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class RequestEditController extends Controller
{
    // Menampilkan daftar permintaan edit untuk dosen wali
    public function indexForDosen()
    {
        $dosen = auth()->user()->dosen;
        $requests = RequestEdit::where('dosen_wali_id', $dosen->dosen_id)
                               ->where('status', 'pending')
                               ->get();
        return view('dosen.request_edit.index', compact('requests'));
    }

    // Menampilkan daftar permintaan edit untuk kaprodi
    public function indexForKaprodi()
    {
        $requests = RequestEdit::where('status', 'pending')->get();
        return view('kaprodi.request_edit.index', compact('requests'));
    }

    // Menampilkan formulir untuk mengedit permintaan
    public function edit(RequestEdit $requestEdit)
    {
        return view('request_edit.edit', compact('requestEdit'));
    }

    // Menyetujuinya permintaan edit
    public function approve(RequestEdit $requestEdit)
    {
        $requestEdit->status = 'approved';
        $requestEdit->save();

        // Update data mahasiswa sesuai permintaan
        $mahasiswa = Mahasiswa::find($requestEdit->mahasiswa_id);
        $mahasiswa->{$requestEdit->field_to_edit} = $requestEdit->new_value;
        $mahasiswa->save();

        // Hapus permintaan setelah disetujui
        $requestEdit->delete();

        return redirect()->route('dosen.request_edit.index')->with('success', 'Permintaan edit berhasil disetujui.');
    }

    // Menolak permintaan edit
    public function reject(RequestEdit $requestEdit)
    {
        $requestEdit->status = 'rejected';
        $requestEdit->save();

        // Hapus permintaan setelah ditolak
        $requestEdit->delete();

        return redirect()->route('dosen.request_edit.index')->with('success', 'Permintaan edit berhasil ditolak.');
    }
}
