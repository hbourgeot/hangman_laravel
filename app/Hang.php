<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hang extends Model
{
    protected $fillable = ['hint', 'answer', 'length'];
}
