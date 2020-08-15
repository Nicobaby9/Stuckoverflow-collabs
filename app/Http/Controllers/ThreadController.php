<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Pertanyaan;
use App\Jawaban;
use App\KomentarPertanyaan;
use App\User;
use Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaan = Pertanyaan::all();

        // dd($pertanyaan);

        return view('thread.index', compact('pertanyaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $jawaban = Jawaban::where('pertanyaan_id', $id)->get();
        $komentar = KomentarPertanyaan::where('pertanyaan_id', $id)->get();
        $user = User::where('id', $pertanyaan['user_id'])->first();
        $jawaban_tepat = Jawaban::where('id', $pertanyaan->jawaban_tepat_id)->first();

        $no = 1;
        return view('thread.show', compact('pertanyaan', 'jawaban', 'komentar', 'user', 'no', 'jawaban_tepat'));
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
        $updatetanya = Pertanyaan::where('id', $id)->update([
            'point_vote' => $request['point_vote_pertanyaan']
        ]);
        $updatejawab = Jawaban::where('id', $id)->update([
            'point_vote' => $request['point_vote_jawaban']
        ]);

        return redirect('thread.show');
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
