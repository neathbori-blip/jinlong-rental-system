<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    // Show all properties (with filters)
    public function index(Request $request)
    {
        $query = Property::query();

        // Filter: keyword
        if ($request->keyword) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        // Filter: type
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // Filter: location
        if ($request->location) {
            $query->where('location', $request->location);
        }

        // Filter: price range
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $properties = $query->paginate(6);

       return view('property', compact('properties'));
    }

    // Store new property
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0', 
            'location' => 'required|string',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'size' => 'nullable|integer',
           'image' => 'nullable|image|max:2048',
            
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('properties', 'public');
        }

        Property::create($validated);

        return redirect()->back()->with('success', 'Property created!');
    }

// Delete property
public function destroy($id)
{
    $property = Property::findOrFail($id);
    $property->delete();
    
    return redirect()->route('properties.index')
        ->with('success', 'Property deleted successfully!');
}


    // Show single property
    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property'));
    }
}


