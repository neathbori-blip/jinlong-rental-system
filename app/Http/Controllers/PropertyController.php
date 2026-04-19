<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('properties.index', compact('properties'));
    }
    
    public function create()
    {
        return view('properties.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
        ]);
        
        Property::create($request->all());
        
        return redirect()->route('properties.index')
            ->with('success', 'Property created successfully.');
    }
}