<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarPertanyaan extends Model
{
    protected $table = 'komentar_pertanyaan';
    protected $guarded = [];

    public function author() {
    	return $this->hasMany('App\User', 'user_id');
    }

    public function komentar_pertanyaan() {
    	return $this->belongsTo('App\Pertanyaan', 'pertanyaan_id');
    }
}
