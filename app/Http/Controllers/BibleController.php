<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BibleController extends Controller
{
    public function index()
    {
        // Get Passage List
        $response = Http::get('https://api-alkitab.herokuapp.com/v2/passage/list');
        $data = $response->body();
        $passage_list = json_decode($data)->passage_list;

        return view('bible.index', compact('passage_list'));
    }

    public function getTotalVerse($passage, $chapter)
    {
        $passage = str_replace(' ', '', $passage);
        $response = Http::get('https://api-alkitab.herokuapp.com/v2/passage/'.$passage.'/'.$chapter);
        $data = $response->body();

        $totalVerse = count(json_decode($data)->verses);

        return $totalVerse;
    }
}
