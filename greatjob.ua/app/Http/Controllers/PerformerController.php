<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App\User;
use App\PerformerCategories;
use App\PerformerExamples;
use App\Category;


class PerformerController extends Controller
{
	public function create()
    {
        if(!Auth::check())
            return redirect('login');

        if(!($user = Auth::user()) || $user->isPerformer == true)
        	return redirect()->back();

        $categories = Category::with('subCategories')
                ->where('parent_id', NULL)->get();
        return view('users.register_performer', compact('categories'));
    }

    public function store(Request $request)
    {
        if(!($user = Auth::user()))
            return redirect('login');
        
        if($user->isPerformer == true)
        	return redirect()->back();

        if($request->categories == null)
        	return redirect()->back();
        try
        {
	        foreach($request->categories as $category)
	        {
	            PerformerCategories::create([
	                'user_id' => $user->id,
	                'category_id' => $category['category_id'],
	                'price' => $category['cost']
	            ]);
	        }
	        if($request->examples != NULL)
	        {
		        foreach($request->examples as $example)
		        {
		        	$exampleName = md5(uniqid('example_', true)).'.'.$example->getClientOriginalExtension();

		        	$image = Image::make($example->getRealPath());
		        	$image->save(storage_path("app\public\\examples\\".$exampleName));

		        	PerformerExamples::create([
		        		'user_id' => $user->id,
		        		'example_picture' => $exampleName
		        	]);
		        }
		   	}

			$user->about = $request->about;
			$user->isPerformer = true;
			$user->save();

		}
	    catch(Exeption $ex)
	    {
	    	return response()->json($ex);
	    }

	   return response()->json($request->all());
    }

    public function storeSuccess()
    {
    	if($user = Auth::user())
    	{
    		if($user->isPerformer == true)
    			return view('users.register_performer_success');
    		else
    			return redirect()->back();
    	}
    }
}
