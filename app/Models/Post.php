<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  protected $table = 'posts';
  public $timestamps = false;

  /**
   * Defines the relation between posts table and the users table,
   * which is a 1 to N relation
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user() {
    return $this->belongsTo('\App\Models\User', 'idUser', 'id');
  }

  /**
   * Simplifies queries that require data from the posts table with data from the users table
   * @param $query
   * @return mixed
   */
  public function scopeWithUser($query) {
    return $query->with(['user' => function($query) {
      $query->select('id', 'username');
    }])->where('public', true);
  }
}