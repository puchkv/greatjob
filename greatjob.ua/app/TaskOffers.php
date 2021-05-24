<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskOffers extends Model
{
    protected $table = 'task_offers';

    protected $fillable = ['message'];

    protected function task()
    {
    	return $this->belongsTo('App\Task', 'task_id');
    }

    protected function performer()
    {
    	return $this->belongsTo('App\User', 'performer_id');
    }
}
