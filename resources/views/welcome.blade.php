<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + Tailwind</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h1 class="text-3xl font-bold text-primary mb-4">
                Laravel + Tailwind
            </h1>
            <p class="text-gray-600 mb-6">
                Your setup is working! 🎉
            </p>
            
            <div class="space-y-4">
                <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark w-full">
                    Primary Button (#3700B3)
                </button>
                
                <button class="bg-secondary text-gray-900 px-4 py-2 rounded hover:bg-secondary-dark w-full">
                    Secondary Button (#03dac6)
                </button>
            </div>
        </div>
    </div>
</body>
</html>