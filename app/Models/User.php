<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model {
  protected $table = 'users';
  public $timestamps = false;

  /**
   * Defines the relation between posts table and the users table,
   * which is a 1 to N relation
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function posts() {
    return $this->hasMany('\App\Models\Post', 'idUser');
  }

  /**
   * Simplifies queries that require data from the posts table with data from the users table
   * @param $query
   * @param $id
   * @return mixed
   */
  public function scopeWithPosts($query, $id) {
    return $query->with(['posts' => function($q) {
      $q->where('public', false);
    }])->where('id', $id)->get(['id', 'username']);
  }

  /**
   * Simplifies queries that require data from the posts table with data from the users table
   * @param $query
   * @param $id
   * @param $slug
   * @return mixed
   */
  public function  scopeWithSlug($query, $id, $slug) {
    return $query->with(['posts' => function($q) use($slug) {
      $q->where('slug', $slug)->where('public', false);
    }])->where('id', $id)->get(['id', 'username']);
  }
}