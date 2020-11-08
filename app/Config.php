<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Config extends Model
{
  protected $fillable = ['key', 'value'];

  public static function getConfigValueOf($key) {
      if( Schema::hasTable('configs')){
        $c = Config::firstOrCreate(['key' => $key]);
      }
      return $c->value;
  }

  public static function setConfigValueOf($key, $value) {
      $c = Config::firstOrCreate(['key' => $key]);
    $c->update(['value' => $value]);
    return ;
  }

  public static function getConfigValues() {
      $confs =  Config::all();
      $configs = [];
      foreach($confs as $conf){
          $configs[$conf->key] = $conf->value;
      }
      return $configs;
  }
}
