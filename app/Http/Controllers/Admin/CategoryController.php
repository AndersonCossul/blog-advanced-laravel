<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Storage\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();
        return view('admin.categories.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $category = $this->category->store($request);

        if ($category == null) {
            Session::flash('error', 'Error on creating new category.');
            return redirect()->back();
        } else {
            Session::flash('success', 'Successfully created category.');
            return redirect()->route('admin.categories');
        }
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request)
    {
        $category = $this->category->update($request);

        if ($category) {
            Session::flash('success', 'Successfully edited.');
            return redirect()->route('admin.categories');
        } else {
            Session::flash('error', 'Error on editing.');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $operation = $this->category->destroy($id);

        if ($operation) {
            Session::flash('success', 'Category trashed succesfully.');
        } else {
            Session::flash('error', 'Failed to trash category.');
        }
        return redirect()->back();
    }

    public function restore($id)
    {
        $operation = $this->category->restore($id);

        if ($operation) {
            Session::flash('success', 'Category restored succesfully.');
        } else {
            Session::flash('error', 'Failed to restore category.');
        }
        return redirect()->back();
    }

    public function permanent_destroy($id)
    {
        $operation = $this->category->permanent_destroy($id);

        if ($operation) {
            Session::flash('success', 'Category permanently deleted.');
        } else {
            Session::flash('error', 'Failed to deleted category.');
        }
        return redirect()->back();
    }
}
