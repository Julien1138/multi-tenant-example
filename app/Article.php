<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Hyn\Tenancy\Traits\UsesTenantConnection;

class Article extends Model
{
    use UsesTenantConnection;

    protected $fillable = ['title', 'content'];
}
