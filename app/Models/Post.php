<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  protected $table = 'posts';
  public $timestamps = false;

  public function user() {
    return $this->belongsTo('\App\Models\User', 'idUser');
  }
}