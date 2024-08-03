<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class DosenController extends Controller
{
     
     public function indexMahasiswa()
     {
         $dosen = auth()->user()->dosen;
         $mahasiswa = Mahasiswa::where('kelas_id', $dosen->kelas_id)->get();
         return view('dosen.mahasiswa.index', compact('mahasiswa'));
     }
 
   
     public function createMahasiswa()
     {
         return view('dosen.mahasiswa.create');
     }
 
     
     public function storeMahasiswa(Request $request)
     {
         $request->validate([
             'id' => 'required|exists:users,id|unique:t_mahasiswa,id',
             'kelas_id' => 'required|exists:t_kelas,kelas_id',
             'nama' => 'required|string|max:100',
             'nim' => 'required|string',
             'tempat_lahir' => 'required|string',
             'tanggal_lahir' => 'required|date',
         ]);
 
         Mahasiswa::create($request->all());
 
         return redirect()->route('dosen.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
     }
 

     public function editMahasiswa(Mahasiswa $mahasiswa)
     {
         return view('dosen.mahasiswa.edit', compact('mahasiswa'));
     }
 

     public function updateMahasiswa(Request $request, Mahasiswa $mahasiswa)
     {
         $request->validate([
             'nama' => 'required|string|max:100',
             'nim' => 'required|string',
             'tempat_lahir' => 'required|string',
             'tanggal_lahir' => 'required|date',
         ]);
 
         $mahasiswa->update($request->all());

         return redirect()->route('dosen.mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
     }
 

     public function destroyMahasiswa(Mahasiswa $mahasiswa)
     {
         $mahasiswa->delete();
 
         return redirect()->route('dosen.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
     }
 
     
     public function indexRequestEdit()
     {
         $dosen = auth()->user()->dosen;
         $requests = RequestEdit::where('dosen_wali_id', $dosen->dosen_id)
                                ->where('status', 'pending')
                                ->get();
         return view('dosen.request_edit.index', compact('requests'));
     }
 
    
     public function editRequestEdit(RequestEdit $requestEdit)
     {
         return view('dosen.request_edit.edit', compact('requestEdit'));
     }
 
     
     public function approveRequestEdit(RequestEdit $requestEdit)
     {
         $requestEdit->status = 'approved';
         $requestEdit->save();
         
         $mahasiswa = Mahasiswa::find($requestEdit->mahasiswa_id);
         $mahasiswa->{$requestEdit->field_to_edit} = $requestEdit->new_value;
         $mahasiswa->save();
 
         $requestEdit->delete();
 
         return redirect()->route('dosen.request_edit.index')->with('success', 'Permintaan edit berhasil disetujui.');
     }

     public function rejectRequestEdit(RequestEdit $requestEdit)
     {
         $requestEdit->status = 'rejected';
         $requestEdit->save();
         $requestEdit->delete();
 
         return redirect()->route('dosen.request_edit.index')->with('success', 'Permintaan edit berhasil ditolak.');
     }
}
