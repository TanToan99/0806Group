<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Department;
use App\Models\Mission;
use App\Models\Semester;
use App\Models\Role;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use App\Http\Requests\MissionRequest;
use DB;
use App\Http\Requests\UpdateMissionRequest as UpdateMission;



class MissionController extends Controller
{
    public function index()
    {
        return view(
            'admin.missions.index',
            [
                'semester' => Semester::all(),
                'department' => Department::all()
            ]
        );
    }

    public function getDtRowData(Request $request)
    {
        if(auth()->user()->hasRole(Role::ROLE_QA_Coordinator))
            $mission = Mission::where('department_id',auth()->user()->department_id)->get();
        else{
            $mission = Mission::all();
        }
        return Datatables::of($mission)
            ->editColumn('name', function ($data) {
                return ' <a href="' . route('admin.ideas.listIdea.index', $data->id) . '">' . $data->name . '</a>';
            })
            ->editColumn('description',function($data){
                return $data->description; 
            })
            ->editColumn('end_at', function($data){
                return $data->end_at;
            })
            ->editColumn('semester', function ($data) {
                return $data->semester->name;
            })
            ->editColumn('action', function ($data) {
                if(auth()->user()->hasRole(Role::ROLE_QA_Manager)) return '';
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.mission.update", $data->id) . '"><i class="fa-solid fa-pen-to-square" title="Edit Mission"></i></a>
                <form method="POST" action="' . route('admin.mission.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('DELETE') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this mission ?\')"><i class="fa-solid fa-trash" title="Delete Mission"></i></button>
                </form>
                ';
            })
            ->rawColumns(['action','name'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }

    public function create(MissionRequest $request)
    {
        //todo: Add create mission request
        
        $name = $request->name;
        $description = $request->description;
        $end_at = $request->end_at;
        $semester = $request->semester;
        if($smt >= $end_at)
        Mission::create([
            'name' => $name,
            'description' => $description,
            'end_at' => $end_at,
            'semester_id' => $semester,
        ]);
        //send mail
        return redirect()->back()->with('success', 'Create Mission Successfully!');
    }

    public function edit($id){
        $mission = Mission::findOrFail($id);
        $department = Department::all();
        $semester = Semester::all();
        return view('admin.missions.editMission', compact('mission','department','semester'));
    }

    public function update(UpdateMission $request, $id){
        $mission = Mission::find($id);
        $name = $request-> name;
        $description = $request->description;
        $end_at = $request->end_at;
        $semester_id = $request->semester_id;
        $data = [
            'name' => $name,
            'description' => $description,
            'end_at' => $end_at,
            'semester_id' => $semester_id,
        ];
        $mission -> update($data);
        $mission->save();
        return redirect('admin/missions') -> with('success', 'Mission successfully updated');    
    }

    public function delete($id)
    {
        $data = Mission::find($id);
        if($data->ideas->count() !== 0)
            return redirect()->back()->with('success', 'Mission cannot delete because it belongs to an Ideas!');
        $data->delete();
        return redirect()->back()->with('success', 'Mission deleted!');
    }

    // public function listMissionByDepartment($id)
    // {
    //     $dpm = Department::find($id);
    //     if (!$dpm) abort(404); //check department exits
    //     return view(
    //         'admin.missions.indexbyDepartment',
    //         [
    //             'department' => $dpm
    //         ]
    //     );
    // }

    public function listMissionBySemester($id)
    {
        $smt = Semester::find($id);
        if (!$smt) abort(404); //check semester exits
        return view(
            'admin.missions.indexbySemester',
            [
                'semester' => $smt
            ]
        );
    }

    // public function getDtRowDataByDepartment($id, Request $request)
    // {
    //     $mission = Mission::where('department_id', $id)->get();
    //     return Datatables::of($mission)
    //         ->editColumn('end_at', function ($data) {
    //             return $data->end_at;
    //         })
    //         ->editColumn('department', function ($data) {
    //             return $data->department->name;
    //         })
    //         ->editColumn('semester', function ($data) {
    //             return $data->semester->name;
    //         })
    //         ->editColumn('action', function ($data) {
    //             return '
    //             <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.mission.update", $data->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
    //             <form method="POST" action="' . route('admin.account.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
    //             ' . method_field('DELETE') .
    //                 '' . csrf_field() .
    //                 '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this account ?\')"><i class="fa-solid fa-trash"></i></button>
    //             </form>
    //             ';
    //         })
    //         ->rawColumns(['action'])
    //         ->setRowAttr([
    //             'data-row' => function ($data) {
    //                 return $data->id;
    //             }
    //         ])
    //         ->make(true);
    // }
    public function getDtRowDataBySemester($id, Request $request)
    {
        $mission = Mission::where('semester_id', $id)->get();
        return Datatables::of($mission)
            ->editColumn('end_at', function ($data) {
                return $data->end_at;
            })
            ->editColumn('semester', function ($data) {
                return $data->semester->name;
            })
           
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.account.update", $data->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
                <form method="POST" action="' . route('admin.account.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('DELETE') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this account ?\')"><i class="fa-solid fa-trash"></i></button>
                </form>
                ';
            })
            ->rawColumns(['action'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
}