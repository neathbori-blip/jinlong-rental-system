<!DOCTYPE html>
<html>
<head>
    <title>Rental Form</title>
</head>
<body>
    <h1>Create New Rental</h1>
    
    <form method="POST" action="/rent">
        @csrf
        <div>
            <label>Item Name:</label>
            <input type="text" name="item_name" required>
        </div>
        <div>
            <label>Customer Name:</label>
            <input type="text" name="customer_name" required>
        </div>
        <div>
            <label>Rental Days:</label>
            <input type="number" name="rental_days" min="1" required>
        </div>
        <div>
            <label>Total Price:</label>
            <input type="number" step="0.01" name="total_price" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>