<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformerExamples extends Model
{
	protected $table = 'performer_examples';

	protected $fillable = ['user_id', 'example_picture'];

    public function exmaples()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
