<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = [
      'id', 'eponimo','onoma','patronimo'
  ];
  public function tmimata(){
      return $this->hasMany('App\Tmima');
  }
  public static function get_num_of_students(){
    return Student::count();
  }
  public function apousies(){
      return $this->hasMany('App\Apousie');
  }
}
