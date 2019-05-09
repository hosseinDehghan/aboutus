<?php

namespace Hosein\Aboutus;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected  $fillable=[
        'id',
        'title',
        'details',
        'image'
    ];
}
