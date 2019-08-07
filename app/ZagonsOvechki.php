<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZagonsOvechki extends Model
{
    protected $table = 'zagons_ovechki';
    protected $guarded = ['_token'];
    protected $fillable=[
        'zagon_id', 'ovechki_id'
    ];
}
