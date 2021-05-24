<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = "user_reviews";

    protected $fillable = ['to_user_id', 'from_user_id', 'task_id', 'message',
        'user_grade','grade_cost', 'grade_quality', 'grade_speed'];

    public function to_user()
    {
    	return $this->belongsTo('App\User', 'to_user_id');
    }
    
    public function from_user()
    {
    	return $this->belongsTo('App\User', 'from_user_id');
    }

    public function task()
    {
    	return $this->belongsTo('App\Task', 'task_id');
    }

    public function getTaskReviewByPerformer($performer_id)
    {
        return $this->belongsTo('App\Task', 'task_id')
            ->where('performer_id', $performer_id);
    }
}
