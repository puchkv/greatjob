<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\Task;
use App\Reviews;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function storeUserReport(Request $request)
    {
        switch($request->user_report_type)
        {
            case 'day':
            {
                $date = Carbon::today();
                $users = User::whereDate('created_at' , $date)->get();
                break;
            }
            case 'week':
            {
                $date = Carbon::today()->subDays(7);
                $users = User::where('created_at', '>=', $date)->get();
                break;
            }
            case 'month':
            {
                $date = Carbon::today()->subDays(30);
                $users = User::where('created_at', '>=', $date)->get();
                break;
            }
            case 'all':
            {
                $users = User::all();
                $date = null;
                break;
            }

        }

        $pdf = PDF::loadView('reports.usersPDF', compact('users', 'date'));
        return $pdf->download(Carbon::now().'-user_report'.'.pdf');
        //return view('reports.usersPDF', compact('users', 'date'));
    }

    public function storeTasksReport(Request $request)
    {
        switch($request->tasks_report_type)
        {
            case 'day':
            {
                $date = Carbon::today();
                $tasks = Task::whereDate('created_at', $date)->get();
                break;
            }
            case 'week':
            {
                $date = Carbon::today()->subDays(7);
                $tasks = Task::where('created_at', '>=', $date)->get();
                break;
            }
            case 'month':
            {
                $date = Carbon::today()->subDays(30);
                $tasks = Task::where('created_at', '>=', $date)->get();
                break;
            }
            case 'all':
            {
                $tasks = Task::all();
                $date = null;
                break;
            }

        }

        $pdf = PDF::loadView('reports.tasksPDF', compact('tasks', 'date'))->setPaper('A4', 'landscape');
        
        //return view('reports.tasksPDF', compact('tasks', 'date'));
        return $pdf->download(Carbon::now().'-tasks_report'.'.pdf');
    }   
}
