<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Pertanyaan;
use App\Jawaban;
use App\Tag;
use Auth;
use Alert;

class JawabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $jawaban = $user->jawabans;

        return view('jawab.index', compact('jawaban'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pertanyaan = Pertanyaan::get();

        // dd($pertanyaan);
        return view('jawab.create', compact('pertanyaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'isi' => 'required'
        ]);

        $jawaban = Jawaban::create([
            'isi' => $request['isi'],
            'pertanyaan_id' => $request['pertanyaan_id']
        ]);

        // dd($jawaban);

        $author = Auth::user();
        $author->pertanyaans()->save($jawaban);

        Alert::alert('Berhasil', 'Data berhasil ditambah', 'success');

        return redirect('/thread')->with('success', 'data berhasil dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $jawaban = Jawaban::findOrFail($id);
        $pertanyaan = Pertanyaan::where('id', $jawaban->pertanyaan_id)->first();
        // dd($pertanyaan);
        return view('jawab.show', compact('pertanyaan', 'jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $pertanyaan = Pertanyaan::where('id', $jawaban->pertanyaan_id)->get();

        // dd($users);

        return view('jawab.edit', compact('pertanyaan', 'jawaban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $update = Jawaban::where('id', $id)->update([
            'isi' => $request['isi']
        ]); 

        return redirect('/jawab')->with('success', 'Jawaban Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Jawaban::destroy($id);

        // dd($delete);

        Alert::alert('Berhasil', 'Data berhasil dihapus', 'warning');

        return redirect('/jawab')->with('success', 'Sukses mengahapus Jawaban.');
    }
}
