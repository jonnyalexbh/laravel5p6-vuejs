<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * index
     *
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $categories = Category::paginate(2);
        return [
            'pagination' => [
                'total' => $categories->total(),
                'current_page' => $categories->currentPage(),
                'per_page' => $categories->perPage(),
                'last_page' => $categories->lastPage(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastItem(),
            ],
            'categories' => $categories,
        ];
    }
    /**
     * store
     *
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->condition = '1';
        $category->save();
    }
    /**
     * update
     *
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->condition = '1';
        $category->save();
    }
    /**
     * deactivate
     *
     */
    public function deactivate(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $category = Category::findOrFail($request->id);
        $category->condition = '0';
        $category->save();
    }
    /**
     * activate
     *
     */
    public function activate(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $category = Category::findOrFail($request->id);
        $category->condition = '1';
        $category->save();
    }
}
