<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class newsController extends Controller
{

    public function index()
    {
        $items = DB::table('news')->get();
        return view('admin.news.index', compact('items'));
    }


    public function create()
    {
        return view('admin.news.create');
    }


    public function store(Request $request)
    {
        // $title = $request->title;
        // $sort = $request->sort;

        // DB::table('news')->insert(
        //     ['title' => $title, 'sort' => $sort]
        // );

        News::create($request ->all());
        return redirect('/admin/news');
    }




    public function edit($id)
    {
        // $items = DB::table('news')->find($id);

        $items = News::find($id);
        return view('admin.news.edit', compact('items'));
    }


    public function update(Request $request, $id)
    {
        // $title = $request->title;
        // $sort = $request->sort;

        // DB::table('news')
        //     ->where('id', $id)
        //     ->update(
        //         ['title' => $title, 'sort' => $sort]
        //     );
        $news = News::find($id);
        $news->update($request->all());
        return redirect('/admin/news');
    }


    public function destroy($id)
    {
       News::destroy($id);
    //    $news = News::find($id);

    //     $news->delete();
        return redirect('/admin/news');
    }
}
