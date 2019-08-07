<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ovechki extends Model
{
    protected $table = 'ovechki';
    protected $fillable=[
        'name'
    ];
    protected $guarded = ['_token'];
}
