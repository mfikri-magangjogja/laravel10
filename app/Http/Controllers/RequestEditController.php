<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class RequestEditController extends Controller
{

    public function indexForDosen()
    {
        $dosen = auth()->user()->dosen;
        $requests = RequestEdit::where('dosen_wali_id', $dosen->dosen_id)
                               ->where('status', 'pending')
                               ->get();
        return view('dosen.request_edit.index', compact('requests'));
    }

    public function indexForKaprodi()
    {
        $requests = RequestEdit::where('status', 'pending')->get();
        return view('kaprodi.request_edit.index', compact('requests'));
    }

    public function edit(RequestEdit $requestEdit)
    {
        return view('request_edit.edit', compact('requestEdit'));
    }

    public function approve(RequestEdit $requestEdit)
    {
        $requestEdit->status = 'approved';
        $requestEdit->save();

        $mahasiswa = Mahasiswa::find($requestEdit->mahasiswa_id);
        $mahasiswa->{$requestEdit->field_to_edit} = $requestEdit->new_value;
        $mahasiswa->save();

        $requestEdit->delete();

        return redirect()->route('dosen.request_edit.index')->with('success', 'Permintaan edit berhasil disetujui.');
    }

    public function reject(RequestEdit $requestEdit)
    {
        $requestEdit->status = 'rejected';
        $requestEdit->save();
        $requestEdit->delete();

        return redirect()->route('dosen.request_edit.index')->with('success', 'Permintaan edit berhasil ditolak.');
    }
}
