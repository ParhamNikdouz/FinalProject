<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = [
		'full_name', 'title_project', 'stu_number', 'master_id', 'term_id', 'defence_situation', 'deadline', 'complementary', 'refree_id'
	];
}
