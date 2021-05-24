<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'performer_id',
        'status',
        'title',
        'description',
        'contacts',
    	'needBeginDate', 
        'needEndDate', 
        'cost',
    	'cost_contract',
        'accepted_at',
        'done_at',
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    protected function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    protected function performer()
    {
        return $this->belongsTo('App\User', 'performer_id');
    }

    protected function review()
    {
        return $this->belongsTo('App\Reviews', 'task_id');
    }

    protected function offers()
    {
        return $this->hasMany('App\TaskOffers');
    }

    public function getStatusName($status)
    {
        switch($status)
        {
            case 'DONE':
                return 'Виконано';
                break;
            case 'CLOS':
                return 'Закрито';
                break;
            case 'PROG':
                return 'Виконується';
                break;
            case 'OPEN':
                return 'Відкрито';
                break;
            case 'DEL':
                return 'Видалено';
                break;
        }
    }

}
