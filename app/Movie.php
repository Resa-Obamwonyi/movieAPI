<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	//stops id from being mass assignable
    protected $guarded = ['id'];
}
