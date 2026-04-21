<?php


 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FormController extends Controller
{
    public function create() {
        return view('form');
    }

    public function store(Request $request) {
    dd($request);
    }
}

