<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
     // Menampilkan daftar kelas
     public function index()
     {
         $kelas = Kelas::all();
         return view('kelas.index', compact('kelas'));
     }
 
     // Menampilkan formulir untuk menambahkan kelas baru
     public function create()
     {
         return view('kelas.create');
     }
 
     // Menyimpan kelas baru ke dalam database
     public function store(Request $request)
     {
         $request->validate([
             'nama' => 'required|string|max:50',
             'kapasitas' => 'required|integer|min:1',
         ]);
 
         Kelas::create($request->all());
 
         return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
     }
 
     // Menampilkan formulir untuk mengedit kelas yang ada
     public function edit(Kelas $kelas)
     {
         return view('kelas.edit', compact('kelas'));
     }
 
     // Memperbarui data kelas yang ada
     public function update(Request $request, Kelas $kelas)
     {
         $request->validate([
             'nama' => 'required|string|max:50',
             'kapasitas' => 'required|integer|min:1',
         ]);
 
         $kelas->update($request->all());
 
         return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
     }
 
     // Menghapus kelas dari database
     public function destroy(Kelas $kelas)
     {
         $kelas->delete();
 
         return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
     }
}
