<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $fillable = [
    	'judul',
    	'isi',
    	'pertanyaan_id'
    ];

    public function author() {
    	return $this->hasMany('App\User', 'user_id');
    }

    public function jawaban() {
    	return $this->belongsTo('App\Pertanyaan', 'pertanyaan_id');
    }

    public function jawaban_tepat() {
        return $this->belongsTo('App\Pertanyaan', 'jawaban_tepat_id');
    }
}
