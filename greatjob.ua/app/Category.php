<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'title'];

    public function subCategories()
    {
    	return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function tasks()
    {
        if($this->parent == null)
    	   return $this->hasManyThrough('App\Task', 'App\Category', 'parent_id', 'category_id')->orderBy('created_at', 'desc');
        else
            return $this->hasMany('App\Task')->orderBy('created_at', 'desc');
    }

    public function getRouteKeyName()
    {
    	return 'slug'; // НАЗВАНИЕ СТОЛБЦА В ТАБЛИЦЕ "КАТЕГОРИИ"
    }
}
