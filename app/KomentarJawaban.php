<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $table = 'komentar_jawaban';
    protected $guarded = [];

    public function author() {
    	return $this->hasMany('App\User', 'user_id');
    }

    public function komentar_jawaban() {
    	return $this->belongsTo('App\Jawaban', 'jawaban_id');
    }
}
