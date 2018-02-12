<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
	protected $fillable = [
		'title', 'max_student'
	 ];
}
