<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label>Title:</label>
            <input type="text" name="title" required>
            @error('title') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label>Content:</label>
            <textarea name="content" required></textarea>
            @error('content') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>