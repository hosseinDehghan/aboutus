<?php

namespace Hosein\Aboutus;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected  $fillable=[
        'id',
        'name',
        'job',
        'image'
    ];
}
