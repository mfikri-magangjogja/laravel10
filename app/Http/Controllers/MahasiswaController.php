<?php

namespace App\Http\Controllers;

use App\Models\RequestEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
 
     public function show()
     {
         $mahasiswa = Auth::user()->mahasiswa;
         return view('mahasiswa.show', compact('mahasiswa'));
     }
 
 
     public function requestEdit()
     {
         return view('mahasiswa.request_edit');
     }
 
     public function storeRequestEdit(Request $request)
     {
         $request->validate([
             'field_to_edit' => 'required|string',
             'new_value' => 'required|string',
         ]);
 
         $mahasiswa = Auth::user()->mahasiswa;
 
         // Validasi agar hanya dapat mengedit data yang diizinkan
         $allowedFields = ['nama', 'nim', 'tempat_lahir', 'tanggal_lahir']; // Misalnya, field yang bisa diubah
         if (!in_array($request->field_to_edit, $allowedFields)) {
             return redirect()->back()->with('error', 'Field yang ingin diubah tidak valid.');
         }
 
         RequestEdit::create([
             'mahasiswa_id' => $mahasiswa->mahasiswa_id,
             'field_to_edit' => $request->field_to_edit,
             'new_value' => $request->new_value,
             'status' => 'pending',
             'dosen_wali_id' => $mahasiswa->kelas->dosen_id,
         ]);
 
         return redirect()->route('mahasiswa.show')->with('success', 'Permintaan edit berhasil diajukan.');
     }
}
