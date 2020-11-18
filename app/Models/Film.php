<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
  protected $fillable = ['judul', 'deskripsi', 'author'];

  protected $date = [];

  public static $rules = [
      'judul' => 'required',
      'deskripsi' => 'required',
      'author' => 'required',
  ];
}

