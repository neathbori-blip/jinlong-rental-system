<?php

namespace App\Http\Controllers;
use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;

class MaintenanceRequestController extends Controller
{
    
public function index()

{
    return MaintenanceRequest::all();
}
    //
}
