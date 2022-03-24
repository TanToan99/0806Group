<?php

namespace App\Http\Controllers\QAManager;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest as UpdateCategory;


class CategoryController extends Controller
{
    public function indexCategory()
    {

        $categories = Category::all();
        return view('admin.category.indexCategory',compact('categories'));
    }

    public function getDtRowData(Request $request)
    {
        $category = Category::all();

        return Datatables::of($category)
            ->editColumn('name', function ($data) {
                return ' <a href="' . route('admin.missions.category.index', $data->id) . '">' . $data->name . '</a>';
            })
            ->editColumn('mission', function ($data) {
                return $data->missions->count();
            })
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.category.update", $data->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
                
                <form method="POST" action="' . route("admin.category.delete", $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('DELETE') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this category ?\')"><i class="fa-solid fa-trash"></i></button>
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

    public function delete($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('flash_message', 'User deleted!');
    }

    public function create(CategoryRequest $request)
    {
        //todo: Add create category request
        Category::create($request->all());
        //send mail
        return redirect()->back()->with('success', 'Create Category Successfully!');
    }
    public function edit($id)
    {
        $dataCategory = Category::findOrFail($id);
        return view('admin.category.editCategory', compact('dataCategory'));
    }
    public function update(UpdateCategory $request, $id)
    {
        $dataCategory = Category::findOrFail($id);
        // assign information to data variable
        $data = $request->all();
        $dataCategory->update($data);
        $dataCategory->save();
        return redirect('admin/category')->with('success', 'Category successfully updated');
    }
}