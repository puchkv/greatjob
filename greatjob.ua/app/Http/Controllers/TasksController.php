<?php

namespace App\Http\Controllers;
use App\Category;
use App\Task;
use Auth;
use App\Reviews;
use App\TaskOffers;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TasksController extends Controller
{
    public function index()
    {
    	if(Auth::check())
    	   return redirect('/profile');
    }

    public function create()
    {
        if(Auth::check())
        {
        	$categories = Category::with('subCategories')
                ->where('parent_id', NULL)->get();
        	return view('tasks.create', compact('categories'));
        }
        else
            return redirect('login');

    }

    public function store(Request $request)
    {
    	$attributes = array(
    		'title' => 'Назва',
    		'category' => 'Категорія',
            'description' => 'Детальний опис',
            'contacts' => 'Контактні дані',
            'needBeginDate' => 'Дата та час (почати з)',
            'needEndDate' => 'Дата та час (завершити до)',
    		'cost' => 'Ціна',
    		'rulesAgree' => 'Правила користування',
    	);
    	$validator = Validator::make($request->all(), [
    		'title' => 'required | min:4 | max:150',
    		'category' => 'required',
            'description' => 'required | min: 4',
            'contacts' => 'required | min: 10',
            'needBeginDate' => 'required | date | afterOrEqual:today ',
            'needEndDate' => 'required | date | afterOrEqual:today | afterOrEqual:needBeginDate',
    		'cost' => 'required | numeric | digits_between: 2, 7',
    		'rulesAgree' => 'accepted',
    	]);
    	$validator->setAttributeNames($attributes);

    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

    	Task::create([
    		'title' => request('title'),
    		'category_id' => request('category'),
    		'user_id' => Auth::id(),
    		'description' => request('description'),
            'contacts' => request('contacts'),
    		'needBeginDate' => request('needBeginDate'),
    		'needEndDate' => request('needEndDate'),
    		'cost' => request('cost'),
    		'cost_contract' => (request('cost_contract') == 'on' ? 1 : 0),
            'status' => 'OPEN'
    	]);
    	return redirect('tasks');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function change(Task $task)
    {
        if(Auth::user() == $task->user)
        {
            return view('tasks.change', compact('task', 'categories'));
        }
    }

    public function refuse(Task $task)
    {
        if($task->user == Auth::user())
        {
            if($task->performer || $task->status != 'DONE' || $task->status != 'CLOS')
            {
                $task->performer_id = null;
                $task->status = 'OPEN';
                $task->accepted_at = null;
                $task->save();
                return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function accept(Task $task, $performer_id)
    {
        if($task->user == Auth::user())
        {
            if(!($task->performer) && $task->status == 'OPEN' 
                && $task->user_id != $performer_id)
            {
                $task->performer_id = $performer_id;
                $task->status = 'PROG';
                $task->accepted_at = Carbon::now();
                $task->save();
                return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function done(Task $task)
    {
        if(Auth::user() == $task->performer || Auth::user() == $task->user)
        {
            if($task->status == 'PROG') {
                $task->status = 'DONE';
            }
            if($task->status == 'OPEN') {
                $task->status = 'CLOS';
            }
            
            $task->done_at = Carbon::now();
            $task->save();

            return redirect()->back();
        }
    }

    public function offers(Task $task)  
    {
        if(Auth::user() == $task->user)
        {
            return view('tasks.offers', compact('task'));
        }
    }

    public function createTaskReview(Task $task)
    {
        if(Auth::check())
        {
            if(Auth::user() == $task->user)
            {
                $review = Reviews::where('task_id', $task->id)->where('from_user_id', $task->user->id)->exists();
                if($review)
                {
                    session()->flash('msg', 'Ви вже залишали відгук на це завдання');
                    return redirect()->back();
                }
                return view('tasks.createPerformerReview', compact('task'));
            }
            else if(Auth::user() == $task->performer)
            {
                $review = Reviews::where('task_id', $task->id)->where('from_user_id', $task->performer->id)->exists();
                if($review)
                {
                    session()->flash('msg', 'Ви вже залишали відгук на це завдання');
                    return redirect()->back();
                }
                return view('tasks.createUserReview', compact('task'));
            }
        }
    }

    public function storeReview(Task $task, Request $request)
    {
        if(Auth::check())
        {
            if(Auth::user() == $task->performer)
            {
                $rating = ($request->grade * 100) / 5;
                if($task->user->rating != 0)
                    $task->user->rating = ($task->user->rating + $rating) / 2;
                else
                    $task->user->rating = $rating;

                Reviews::create([
                    'to_user_id' => $task->user->id,
                    'from_user_id' => $task->performer->id,
                    'task_id' => $task->id,
                    'message' => $request['message'],
                    'user_grade' => $request['grade']
                ]);

                $task->user->save();

                return redirect('/user/' . $task->user->id);

            }
            else if(Auth::user() == $task->user)
            {
                $rating = (($request->grade_speed + $request->grade_quality + $request->grade_cost) * 100) / (5 * 3);
                if($task->performer->rating != 0)
                    $task->performer->rating = ($task->performer->rating + $rating) / 2;
                else
                    $task->performer->rating = $rating;

                Reviews::create([
                    'to_user_id' => $task->performer->id,
                    'from_user_id' => $task->user->id,
                    'task_id' => $task->id,
                    'message' => $request['message'],
                    'grade_speed' => $request['grade_speed'],
                    'grade_quality' => $request['grade_quality'],
                    'grade_cost' => $request['grade_cost']
                ]);

                $task->performer->save();

                return redirect('/user/' . $task->performer->id);
            }
        }
    }

    public function propose(Task $task)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->isPerformer)
            {
                $offer = TaskOffers::where('performer_id', $user->id)
                ->where('task_id', $task->id)->exists();
                if($offer)
                {
                    session()->flash('msg', 'Ви вже запропонували свої послуги. Дочекайтесь доки з вами зв\'яжеться замовник');
                    return redirect()->back();
                }
                return view('tasks.propose', compact('task'));
            }
        }
    }

    public function storePropose(Task $task, Request $request)
    {
         if(Auth::check())
        {
            $user = Auth::user();

            if($user->isPerformer)
            {
                $offer = new TaskOffers();
                $offer->performer_id = $user->id;
                $offer->task_id = $task->id;
                if($request['message'] != '')
                    $offer->message = $request['message'];
                $offer->save();

                return redirect('/task/' . $task->id);
            }
            return redirect()->back();
        }
    }


    public function update()
    {

    }

    public function destroy()
    {

    }
}
