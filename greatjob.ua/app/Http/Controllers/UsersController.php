<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\Task;
use App\Category;
use App\Reviews;
use App\PerformerCategories;
use App\PerformerExamples;
use Auth;

class UsersController extends Controller
{
    public function show(User $user)
    {
    	if($user == Auth::user())
    		return redirect('profile');
    	else
        {

            $tasks = Task::where('user_id', $user->id)->paginate(10, ['*'], 'tasks_page');
            $reviews = Reviews::where('to_user_id', $user->id)->paginate(3, ['*'], 'reviews_page');

            if($user->isPerformer)
            {
                $works = Task::where('performer_id', $user->id)->paginate(10, ['*'], 'works_page');
                $examples = PerformerExamples::where('user_id', $user->id)
                    ->paginate(9, ['*'], 'examples_page');
                return view('users.show', compact('user', 'tasks', 'reviews', 'examples', 'works'));
            }
    		return view('users.show', compact('user', 'tasks', 'reviews'));
        }
    }

    public function profile()
    {
    	if($user = Auth::user())
        {
            $tasks = Task::where('user_id', $user->id)->paginate(10, ['*'], 'tasks_page');
            $reviews = Reviews::where('to_user_id', $user->id)->paginate(3, ['*'], 'reviews_page');

            if($user->isPerformer == true)
            {
                $works = Task::where('performer_id', $user->id)->paginate(10, ['*'], 'works_page');
                $examples = PerformerExamples::where('user_id', $user->id)
                    ->paginate(9, ['*'], 'examples_page');
                
                return view('users.profile', compact('user', 'tasks', 'works', 'examples', 'reviews'));
            }
    		return view('users.profile', compact('user', 'tasks', 'reviews'));
        }
    	else
    		return redirect('login');
    }

    public function change()
    {
        if($user = Auth::user())
            return view('users.change', compact('user'));
        else
            return redirect('login');
    }

    public function performers()
    {
        $performers = User::where('isPerformer', 1)->get();
        return view('users.performers', compact('performers'));
    }

    public function update(Request $request)
    {
        if($user = Auth::user())
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required | string | max:255',
                'phone' => 'required | digits:10 | unique:users,phone,'.$user->id, 
                'city' => 'required | string | min:3 | max:50',
                'picture' => 'image | mimes:jpeg,png,jpg,gif | max:2048'
            ]);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user->name = $request->name;
            $user->city = $request->city;
            $user->phone = $request->phone;

            if($request->picture != null)
            {
                if($user->picture != 'default_userpic.png')
                {
                    $path = storage_path("app\public\pictures\\".$user->picture);
                    
                    if(file_exists($path))
                        @unlink($path);
                }
                $user->picture = $user->CreateThumbnail($request->picture);
            }

            $user->save();

            return redirect('profile');
        }
    }
}
