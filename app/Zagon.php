<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zagon extends Model
{
    protected $table = 'zagons';
    protected $guarded = ['_token'];
}
