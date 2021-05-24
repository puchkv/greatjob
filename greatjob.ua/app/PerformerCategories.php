<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformerCategories extends Model
{
    protected $fillable = ['category_id', 'user_id', 'price'];

    public function category()
    {
    	return $this->belongsTo('App\Category', 'category_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
