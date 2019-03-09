<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
//いいねリレーション要らず
//   public function goods(){
//       return $this->hasMany('App\Good');
//   }

//　ハッシュタグ
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function hashTags()
    {
        return $this->belongsToMany('App\HashTag');
    }
}
