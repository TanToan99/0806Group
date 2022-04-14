<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;
use App\Models\Comment;
use App\Models\Mission;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Yajra\Datatables\Datatables;

class IdeasController extends Controller
{
     public function index()
    {
        $ideas = Idea::all();
        $user = User::all();
        $missions = Mission::all();
        return view(
            'admin.ideas.index', compact(['user','ideas','missions']));
    }
    
    public function getDtRowData(Request $request){
        $ideas = Idea::all();
        // dd($ideas);
        return Datatables::of($ideas)
            ->editColumn('title', function ($data) {
                return ' <a href="' . route('admin.comments.listComment.index', $data->id) . '">' . $data->title . '</a>';
            })
            ->editColumn('content', function($data){
                return substr($data->content,0,100);
            })
            ->editColumn('user', function($data){
                return $data->user->name;
            })
            ->editColumn('mission', function ($data) {
                return $data->mission->name;
            })
            ->editColumn('like', function($data){
                return $data->getLoveReactant()->getReactionCounterOfType(ReactionType::fromName('Like'))->getCount();
            })
            ->editColumn('dislike', function($data){
                return $data->getLoveReactant()->getReactionCounterOfType(ReactionType::fromName('Dislike'))->getCount();
            })
            ->editColumn('comments', function ($data) {
                return $data->comments->count();
            })
            ->editColumn('action', function ($data){
                return '
                <form method="POST" action="' . route('admin.ideas.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('DELETE') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this ideas ?\')"><i class="fa-solid fa-trash"></i></button>
                </form>
                ';
            })
            ->rawColumns(['action','title'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }

    // List idea by mission
    public function listIdeaByMission($id)
    {
        $missions = Mission::find($id);
        if (!$missions) abort(404); //check missions exits
        return view(
            'admin.ideas.indexbyMission',
            [
                'mission' => $missions
            ]
        );
    }
    public function delete($id)
    {
        $data = Idea::find($id);
        //Delete all comments beloging to idea
        $comments = Comment::where('idea_id', $id);
        $comments->delete();
        //Delete all attached files beloging to idea
        //in the public folder
        $directory = 'public/idea/' . $id;
        Storage::deleteDirectory($directory);
        //in database
        $attached_files = Attachment::where('idea_id', $id);
        $attached_files->delete();
        $data->delete();
        return redirect()->back()->with('success', 'Ideas deleted!');

    }

    public function getDtRowDataByMission($id, Request $request)
    {
        $missions = Idea::where('mission_id', $id)->get();
        return Datatables::of($missions)
            ->editColumn('title', function ($data) {
                return $data->title;
            })
            ->editColumn('content', function ($data) {
                return $data->content;
            })
            ->editColumn('user', function ($data) {
                return $data->user->name;
            })
            ->editColumn('mission', function ($data) {
                return $data->mission->name;
            })
            ->make(true);
    }
}
