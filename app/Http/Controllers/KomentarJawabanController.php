<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Jawaban;
use App\KomentarJawaban;
use Auth;
use Alert;

class KomentarJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jawaban = Jawaban::get();

        // dd($jawaban);
        return view('komentarJawaban.create', compact('jawaban'));
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

        $komentarjawaban = Komentarjawaban::create([
            'isi' => $request['isi'],
            'jawaban_id' => $request['jawaban_id']
        ]);

        // dd($jawaban);

        $author = Auth::user();
        $author->jawabans()->save($komentarjawaban);

        Alert::alert('Success', 'Komentar Berhasil Ditambahkan', 'success');

        return redirect('/thread')->with('success', 'Komentar Berhasil Ditambahkan');
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
        $komentar_jawaban = KomentarJawaban::where('jawaban_id', $id)->get();

        return view('komentarJawaban.show', compact('jawaban', 'komentar_jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
