<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anathesi extends Model
{
  protected $fillable = [
      'user_id','tmima'
  ];
    public function user()
   {
       return $this->belongsTo('App\User');
   }
}
