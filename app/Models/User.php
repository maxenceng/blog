<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model {
  protected $table = 'users';
  public $timestamps = false;

  public function posts() {
    return $this->hasMany('\App\Models\Post', 'idUser');
  }

  public function scopeWithPosts($query, $id) {
    return $query->with(['posts' => function($q) {
      $q->where('public', false);
    }])->where('id', $id)->get(['id', 'username']);
  }

  public function  scopeWithSlug($query, $id, $slug) {
    return $query->with(['posts' => function($q) use($slug) {
      $q->where('slug', $slug)->where('public', false);
    }])->where('id', $id)->get(['id', 'username']);
  }
}