<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $guarded = [];

    public function author() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function jawabans() {
    	return $this->hasMany('App\Jawaban', 'pertanyaan_id');
    }

    public function jawaban_tepat() {
        return $this->hasOne('App\Jawaban', 'jawaban_tepat_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'post_tag', 'pertanyaan_id', 'tag_id');
    }
}
