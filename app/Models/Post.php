<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  protected $table = 'posts';
  public $timestamps = false;

  public function user() {
    return $this->belongsTo('\App\Models\User', 'idUser', 'id');
  }

  public function scopeWithUser($query) {
    return $query->with(['user' => function($query) {
      $query->select('id', 'username');
    }])->where('public', true);
  }
}