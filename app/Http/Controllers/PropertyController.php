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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'total_units' => 'required|integer|min:1',
            'occupied_units' => 'required|integer|min:0|lte:total_units',
            'monthly_revenue' => 'required|numeric|min:0',
        ]);

        Property::create($validated);

        return redirect()->route('properties.index')
                         ->with('success', 'Property added successfully!');
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'total_units' => 'required|integer|min:1',
            'occupied_units' => 'required|integer|min:0|lte:total_units',
            'monthly_revenue' => 'required|numeric|min:0',
        ]);

        $property = Property::findOrFail($id);
        $property->update($validated);

        return redirect()->route('properties.index')
                         ->with('success', 'Property updated successfully!');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->route('properties.index')
                         ->with('success', 'Property deleted successfully!');
    }
}