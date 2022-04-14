<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use App\Models\Account;
use App\Models\Mission;
use App\Models\Semester;
use DB;


class AdminController extends Controller
{
    public function index()
    {
        $department = DB::table('departments')->count();
        $semester = DB::table('semesters')->count();
        $account = DB::table('users')->count();
        $mission = DB::table('missions')->count();
        $semesters = Semester::get(); //first()->ideas->count()

        $academic = Department::where('name',Department::ACADEMIC)->first();
        $count_academic = $academic->ideas->count();
        $support = Department::where('name',Department::SUPPORT)->first();
        $count_support = $support->ideas->count();

        $total = $count_academic + $count_support;
        $count_academic_per = $count_academic/$total * 100;
        $count_support_per = $count_support/$total * 100;

        $count_academic_contribute = User::withCount(['ideas as count_idea'])->withCount(['comments as count_comments'])->having('count_idea','>','0')->orHaving('count_comments','>','0')->where('department_id','=',$academic->id)->get()->count();
        $count_support_contribute = User::withCount(['ideas as count_idea'])->withCount(['comments as count_comments'])->having('count_idea','>','0')->orHaving('count_comments','>','0')->where('department_id','=',$support->id)->get()->count();
        return view('admin.dashboard', compact(
            'department',
            'semester',
            'account',
            'mission',
            'count_academic',
            'count_support',
            'count_academic_per',
            'count_support_per',
            'semesters',
            'count_academic_contribute',
            'count_support_contribute'
        ));
    }

    
}
