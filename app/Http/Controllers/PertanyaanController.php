<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Pertanyaan;
use App\Jawaban;
use App\Tag;
use Auth;
use Alert;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pertanyaan = $user->pertanyaans;
        $no = 1;

        // dd($user);

        return view('pertanyaan.index', ['pertanyaan' => $pertanyaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required'
        ]);

        //Explode string to array
        $tags_string = $request["tags"];
        $tags_arr = explode(",", $tags_string);
        
        $tag_ides = [];
        foreach ($tags_arr as $tag_name) {
            $tag = Tag::where('tag_name', $tag_name)->first();
            if ($tag) {
                $tag_ides[] = $tag->id;
            }else {
                $new_tag = Tag::create(['tag_name' => $tag_name]);
                $tag_ides[] = $new_tag->id;
            }
        }

        //Create to database
        $pertanyaan = Pertanyaan::create([
            'judul' => $request['judul'],
            'isi' => $request['isi']
        ]);

        $pertanyaan->tags()->sync($tag_ides);

        $author = Auth::user();
        $author->pertanyaans()->save($pertanyaan);

        Alert::alert('Berhasil', 'Data berhasil ditambah', 'success');

        return redirect('/question')->with('success', 'data berhasil dimasukkan');
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
        $jawaban_tepat = Jawaban::where('id', $pertanyaan->jawaban_tepat_id)->first();
        
        // dd($jawaban_tepat);

        return view('/pertanyaan.show', compact('pertanyaan', 'jawaban', 'jawaban_tepat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $jawaban = Jawaban::where('pertanyaan_id', $id)->get();

        // dd($users);

        return view('/pertanyaan.edit', compact('pertanyaan', 'jawaban'));
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
        $update = Pertanyaan::where('id', $id)->update([
            'judul' => $request['judul_pertanyaan'],
            'isi' => $request['isi_pertanyaan'],
            'jawaban_tepat_id' => $request['jawaban_tepat_id']
        ]); 

        return redirect('/question')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Pertanyaan::destroy($id);

        // dd($delete);

        Alert::alert('Berhasil', 'Data berhasil dihapus', 'warning');

        return redirect('/question')->with('success', 'Sukses mengahapus data.');
    }
}
