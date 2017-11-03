<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Hyn\Tenancy\Traits\UsesSystemConnection;

class Blog extends Model
{
    use UsesSystemConnection;

    protected $fillable = ['name'];
}
