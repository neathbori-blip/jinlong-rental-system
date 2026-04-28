<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     */
    public function index(Request $request)
    {
        $query = Property::query();

        // Search by keyword (title or description)
        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
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

        // Paginate results (6 per page as shown in your view)
        $properties = $query->paginate(6);

        return view('property', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created property.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'size' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
            $validated['image'] = $imagePath;
        }

        Property::create($validated);

        return redirect()->route('properties.index')
            ->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified property.
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property'));
    }

    /**
     * Remove the specified property.
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        
        // Delete image if exists
        if ($property->image) {
            \Storage::disk('public')->delete($property->image);
        }
        
        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Property deleted successfully!');
    }
}