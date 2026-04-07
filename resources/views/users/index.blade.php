<!DOCTYPE html>
<html>
<head>
    <title>បញ្ជីអ្នកប្រើប្រាស់</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">បញ្ជីអ្នកប្រើប្រាស់</h1>
        
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            បន្ថែមអ្នកប្រើប្រាស់ថ្មី
        </a>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">ឈ្មោះ</th>
                        <th class="px-4 py-2 border">អ៊ីមែល</th>
                        <th class="px-4 py-2 border">តួនាទី</th>
                        <th class="px-4 py-2 border">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $user->id }}</td>
                        <td class="px-4 py-2 border">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->role }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:underline mr-2">មើល</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-green-500 hover:underline mr-2">កែប្រែ</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('តើអ្នកពិតជាចង់លុបមែនទេ?')" class="text-red-500 hover:underline">
                                    លុប
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>