<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 font-body">
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex flex-col items-center text-center md:flex-row md:text-left">
            <div class="md:w-1/2">
                <h1 class="font-bold text-red-700 text-9xl">403</h1>
                <p class="mt-4 text-2xl font-semibold text-gray-800">Unauthorized</p>
                <p class="mt-2 text-gray-600">{{ $exception->getMessage() }}</p>
                <a href="{{ url()->previous() }}" class="mt-6 text-white bg-blue-700 btn hover:bg-blue-500">Take me home</a>
            </div>
            <div class="mt-6 md:w-1/2 md:mt-0">
                <img src="https://via.placeholder.com/400" alt="404 Illustration" class="w-full h-auto">
            </div>
        </div>
    </div>
</body>
</html>
