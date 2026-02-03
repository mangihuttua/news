<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    public function index()
    { 
        $news = News::paginate(6);
        return view('index', compact('news'));
    }

    public function detail_news($id)
    {
        $news = News::find($id);
        return view('detail', compact('news'));
    }

}
