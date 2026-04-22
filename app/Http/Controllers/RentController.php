<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;

class RentController extends Controller
{
    // Show the form (GET request)
    public function create()
    {
        return view('rent');
    }

    // Store data (POST request)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'rental_days' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        Rent::create($validated);

        return redirect()->route('rent')->with('success', 'Rent created successfully!');
    }

    // Show all data
    public function index()
    {
        $rent = Rent::all();
        return view('rent', compact('rent'));
    }
}