<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
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

        $searchFor = $request->searchFor;
        $criterion = $request->criterion;

        if ($searchFor == '') {
            $articles = Article::join('categories', 'articles.category_id', '=', 'categories.id')
                ->select('articles.id', 'articles.category_id', 'articles.code', 'articles.name', 'categories.name as name_category', 'articles.sale_price', 'articles.stock', 'articles.description', 'articles.condition')
                ->orderBy('articles.id', 'desc')->paginate(3);
        } else {
            $articles = Article::join('categories', 'articles.category_id', '=', 'categories.id')
                ->select('articles.id', 'articles.category_id', 'articles.code', 'articles.name', 'categories.name as name_category', 'articles.sale_price', 'articles.stock', 'articles.description', 'articles.condition')
                ->where('articles.' . $criterion, 'like', '%' . $buscar . '%')
                ->orderBy('articles.id', 'desc')->paginate(3);
        }

        return [
            'pagination' => [
                'total' => $articles->total(),
                'current_page' => $articles->currentPage(),
                'per_page' => $articles->perPage(),
                'last_page' => $articles->lastPage(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastItem(),
            ],
            'articles' => $articles,
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

        $article = new Article();
        $article->category_id = $request->category_id;
        $article->code = $request->code;
        $article->name = $request->name;
        $article->sale_price = $request->sale_price;
        $article->stock = $request->stock;
        $article->description = $request->description;
        $article->condition = '1';
        $article->save();
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

        $article = Article::findOrFail($request->id);
        $article->category_id = $request->category_id;
        $article->code = $request->code;
        $article->name = $request->name;
        $article->sale_price = $request->sale_price;
        $article->stock = $request->stock;
        $article->description = $request->description;
        $article->condition = '1';
        $article->save();
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

        $article = Article::findOrFail($request->id);
        $article->condition = '0';
        $article->save();
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

        $article = Article::findOrFail($request->id);
        $article->condition = '1';
        $article->save();
    }
}
