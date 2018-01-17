<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function __construct(){
        View::share('link', 'categories');
    }

    function list() {
        $cats = Categories::all();
        $tree = Categories::withDepth()->get()->toTree()->toArray();

        return view('categories/list', [
            'activeCatId' => request()->id ? request()->id : '',
            'categories' => $cats,
            'treeCategories' => $tree
        ]);
    }

    function create(Request $req) {
        $cats = new Categories();
        $cats->name = $req->name;
        $cats->parent_id = $req->parent_id;
        $cats->save();

        return redirect('/categories');
    }

    function view(Request $req) {
        $cats = Categories::withDepth()->descendantsAndSelf($req->id)->toTree()->toArray();
        return view('categories/view', [
            'categories' => $cats
        ]);
    }
}
