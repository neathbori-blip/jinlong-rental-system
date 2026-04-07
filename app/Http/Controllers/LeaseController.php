<?php

namespace App\Http\Controllers;
use App\Models\Lease;
use Illuminate\Http\Request;

class LeaseController extends Controller
{

public function index()

{
    return Lease::all();
}
    //
}
