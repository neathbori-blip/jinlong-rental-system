<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;

class RentController extends Controller
{
    // Show the form (GET request)
    public function create()
    {
        return view('layouts.rent');
    }
    
    // Store data (POST request) - THIS IS THE POST METHOD
    public function store(Request $request)
    {
        // Validate the data
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'rental_days' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
        ]);
        
        // Store in database
        $rent = Rent::create($validated);
        
        // Return response
        return redirect()->route('rent.store')->with('success', 'Data stored successfully!');
    }
}