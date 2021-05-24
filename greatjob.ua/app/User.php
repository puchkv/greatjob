<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\ImageManagerStatic as Image;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'city', 'password', 'picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task', 'user_id', 'id')->orderBy('created_at', 'desc');
    }

    public function examples()
    {
        return $this->hasMany('App\PerformerExamples', 'user_id', 'id');
    }

    public function category_prices()
    {
        return $this->hasMany('App\PerformerCategories', 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Reviews', 'to_user_id', 'id');
    }

    public function sendReviews()
    {
        return $this->hasMany('App\Reviews', 'from_user_id', 'id');
    }

    public function works()
    {
        return $this->hasMany('App\Task', 'performer_id', 'id')->orderBy('created_at', 'desc');
    }

    public function performers()
    {
        return $this->where('isPerformer', true);
    }

    public function getDoneWorks()
    {
        return $this->hasMany('App\Task', 'performer_id', 'id')->where('status', 'DONE')->orWhere('status', 'CLOS')->orderBy('created_at', 'desc');
    }

    public function getUserRole()
    {
        if($this->isPerformer)
            return 'Виконавець';
        else
            return 'Замовник';
    }

    public function getUserGrade($review)
    {
        $grade = ($review->user_grade * 100) / 5;
        return $this->getGradeName($grade);
    }

    public function getPerformerGrade($review)
    {
        $total = $review->grade_speed + $review->grade_quality + $review->grade_cost;
        $grade = ($total * 100) / 15;
        return $this->getGradeName($grade);
    }

    public function getGradeName($grade)
    {
        switch(true)
        {
            case ($grade < 20):
                return 'Жахливо (' . round($grade) . '%)';
                break;
            case ($grade < 50):
                return 'Погано (' . round($grade) . '%)';
                break;
            case ($grade < 70):
                return 'Задовільно (' . round($grade) . '%)';
                break;
            case ($grade < 90):
                return 'Гарно (' . round($grade) . '%)';
                break;
             case ($grade <= 100):
                return 'Відмінно (' . round($grade) . '%)';
                break;    
        }
    }


    public function getRatingColor()
    {
        switch(true)
        {
            case($this->rating == 0):
                return '';
                break;
            case ($this->rating < 40):
                return 'red';
                break;
            case($this->rating < 70):
                return '';
                break;
            case($this->rating <= 100):
                return 'green';
                break;
        }
    }

    public function CreateThumbnail($picture)
    {
        $pictureName = $this->id.'_picture'.time().'.'.$picture->getClientOriginalExtension();
        $canvas = Image::canvas(200, 200);
        $image = Image::make($picture->getRealPath())->fit(200, 200);
        $canvas->insert($image, 'center');
        $canvas->save(storage_path("app\public\pictures\\".$pictureName));

        return $pictureName;
    }
}
