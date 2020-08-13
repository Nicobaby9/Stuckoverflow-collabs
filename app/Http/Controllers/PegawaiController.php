<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index() {
    	//mengambil data dari table pegawai
    	$pegawai = DB::table('pegawai')->get();
    	
    	//mengirim data ke view index
    	return view('pegawai.index', ['pegawai'=> $pegawai]);
    }

    public function tambah() {

    	//memanggil view tambah
    	return view('tambah');
    }

    public function store(Request $request) {

    	//Inset data ke dalam database
    	DB::table('pegawai')->insert([
    		'pegawai_nama' => $request->nama,
    		'pegawai_jabatan' => $request->jabatan,
    		'pegawai_umur' => $request->umur,
    		'pegawai_alamat' => $request->alamat

    	]);
    	return redirect('/pegawai')->with("data berhasil dimasukkan");

    }

    public function edit($id) {
    	//mengambil data pegawai berdasarkan id yang terpilih
    	$pegawai = DB::table('pegawai')->where('pegawai_id',$id)->get();

    	//passing data pegawai yang didapat ke view edit.blade.php
    	return view('/edit', ['pegawai'=> $pegawai]);
    }

    public function update(Request $request) {
    	//update data pegawai
    	DB::table('pegawai')->where('pegawai_id', $request->id)->update([
    		'pegawai_nama' => $request->nama,
			'pegawai_jabatan' => $request->jabatan,
			'pegawai_umur' => $request->umur,
			'pegawai_alamat' => $request->alamat
    	]);

    	//kembalikan halaman ke halaman index pegawai
    	return redirect('/pegawai');
    }

    public function hapus($id) {
    	// menghapus data pegawai berdasarkan id yang dipilih
		DB::table('pegawai')->where('pegawai_id',$id)->delete();

		// alihkan halaman ke halaman pegawai
		return back()->with('Success', 'Sukses mengahpus data.');
    }
}
