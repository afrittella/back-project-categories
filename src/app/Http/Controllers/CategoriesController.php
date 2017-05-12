<?php

namespace Afrittella\BackProjectCategories\Http\Controllers;

use Afrittella\BackProject\Facades\SlugGenerator;
use Afrittella\BackProject\Http\Controllers\Controller;
use Afrittella\BackProject\Exceptions\NotFoundException;
use Afrittella\BackProject\Repositories\Attachments;
use Afrittella\BackProjectCategories\Http\Requests\CategoryAdd;
use Afrittella\BackProjectCategories\Http\Requests\CategoryEdit;
use Afrittella\BackProjectCategories\Domain\Repositories\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prologue\Alerts\Facades\Alert;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Categories $categories)
    {


        $root = $categories->findBy('slug', 'root');

        if (!empty($root)) {
            return redirect(route('categories.edit', [$root->id]));
        }

        return view('back-project-categories::categories.index')->with('categories', $categories->transform($categories->all()));
    }

    public function edit(Request $request, Categories $categories, $id)
    {
        return view('back-project-categories::categories.edit')
            ->with([
                'category' => $categories->find($id),
                'children' => $categories->children($id)
            ]);
    }

    public function create()
    {
        return view('back-project-categories::categories.create');
    }

    public function delete(Categories $categories, $id)
    {
        $categories->delete($id);

        Alert::add('success', trans('back-project::crud.model_deleted', ['model' => trans('back-project-categories::categories.category')]))->flash();

        return back();
    }

    public function up(Request $request, Categories $categories, $id)
    {
        $categories->moveUp($id);
        return back();
    }

    public function down(Request $request, Categories $categories, $id)
    {
        $categories->moveDown($id);
        return back();
    }

    public function store(CategoryAdd $request, Categories $categories)
    {
        $category = $categories->create($request->all());

        Alert::add('success', trans('back-project::crud.model_created', ['model' => trans('back-project-categories::categories.category')]))->flash();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json();
        } else {
            return redirect(route('categories.index'));
        }
    }

    public function update(CategoryEdit $request, Categories $categories, $id)
    {
        $category = $categories->update($request->all(), $id);

        Alert::add('success', trans('back-project::crud.model_updated', ['model' => trans('back-project-categories::categories.category')]))->flash();

        return back();
    }

    public function addImage(Request $request, Attachments $attachments, Categories $categories, $id)
    {
        $user = Auth::user();

        $categories->addAttachment($request->all(), $user->id, $id);

        Alert::add('success', trans('back-project::base.image_uploaded'))->flash();

        return response()->json([
            'success' => true,
            'message' => trans('back-project::base.image_uploaded')
        ]);
    }
}
