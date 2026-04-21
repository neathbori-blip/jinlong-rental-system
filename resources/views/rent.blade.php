<!DOCTYPE html>
<html>
<head>
    <title>Rent Form</title>
</head>
<body>
    @if(session('success'))
        <div style="color: green; padding: 10px; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red; padding: 10px; margin: 10px 0;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('rent.store') }}">
        @csrf  {{-- IMPORTANT: CSRF protection for POST --}}
        
        <div>
            <label>Item Name:</label>
            <input type="text" name="item_name" value="{{ old('item_name') }}" required>
        </div>
        
        <div>
            <label>Customer Name:</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required>
        </div>
        
        <div>
            <label>Rental Days:</label>
            <input type="number" name="rental_days" value="{{ old('rental_days') }}" required>
        </div>
        
        <div>
            <label>Total Price:</label>
            <input type="number" step="0.01" name="total_price" value="{{ old('total_price') }}" required>
        </div>
        
        <button type="submit">Submit Rent Data</button>
    </form>
</body>
</html>