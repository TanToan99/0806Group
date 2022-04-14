<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Idea;
use App\Models\Comment;

class ComentController extends Controller
{
    public function listCommentByIdea($id)
    {
        $ideas = Idea::find($id);
        if (!$ideas) abort(404); //check ideas exits
        return view(
            'admin.comments.indexbyIdea',
            [
                'ideas' => $ideas
            ]
        );
    }
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted!');
    }

    public function getDtRowDataByIdea($id, Request $request)
    {
        $ideas = Comment::where('idea_id', $id)->get();
        return Datatables::of($ideas)
            ->editColumn('content', function ($data) {
                return $data->content;
            })
            ->editColumn('user', function ($data) {
                return $data->user->name;
            })
            ->editColumn('idea', function ($data) {
                return $data->idea->title;
            })
            ->editColumn('action', function($data){
                return '
                <form method="POST" action="' . route('admin.comments.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('DELETE') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this comment ?\')"><i class="fa-solid fa-trash"></i></button>
                </form>
                ';
            })
            ->rawColumns(['action', 'name'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
}
