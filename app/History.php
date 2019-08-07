<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table='history';
    protected $fillable=[
        'name','zagon_id','ovechki_id'
    ];
    protected $guarded = ['_token'];
}
