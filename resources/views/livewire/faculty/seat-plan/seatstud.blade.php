<!DOCTYPE html>
<html data-theme="light" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generated PDF File</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body">

    <header class="flex justify-between items-center p-6">
        <img src="{{ $cspcimageBase64 }}" alt="CSPC Logo" class="h-16">
        <img src="{{ $ccsimageBase64 }}" alt="CCS Logo" class="h-16">
    </header>

    <hr class="border-t-4 border-gray-300">

    <div class="flex flex-col justify-center items-center mt-6">
        <h1 class="text-2xl font-bold">STUDENT'S SEAT PLAN</h1>
        <div class="text-1xl font-medium">SUBJECT: <span class="font-bold">{{ $subject ?? ' ' }}</span></div>
        <div class="text-1xl font-medium">SECTION: <span class="font-bold">{{ $section ?? ' ' }}</span></div>
        <div class="text-1xl font-medium">FACULTY: <span class="font-bold">{{ $faculty ?? ' ' }}</span></div>
    </div>

    <div class="flex items-center justify-center">
        <div class="grid grid-cols-2 gap-2 p-10 text-white">
            @php
                // Create an associative array keyed by seat number for easy access
                $seatplan = \App\Models\SeatConfiguration::all()->groupBy('row');
                $seatplansArray = $seatStuds->keyBy('seat_number')->toArray();
            @endphp

            @foreach ($seatplan as $row)
                <div class="flex justify-center">
                    @foreach ($row as $seat)
                        @if ($seat->seat_number === 0)
                            <div class="flex items-center justify-center" style="width: 40px; height: 40px; margin: 5px;" class="tooltip"></div>
                        @elseif (!isset($seatplansArray[$seat->seat_number]))
                            <div id="{{ $seat->seat_number }}" class="flex items-center justify-center bg-blue-700 border border-black box font-medium" style="width: 40px; height: 40px; margin: 5px;">{{ $seat->seat_number }}</div>
                        @else
                            <div id="{{ $seat->seat_number }}" class="flex items-center justify-center bg-red-700 border border-black box font-medium" style="width: 40px; height: 40px; margin: 5px;">{{ $seat->seat_number }}</div>
                        @endif
                    @endforeach
                </div>
            @endforeach

            <div class="flex justify-center col-span-2 mt-5">
                <div class="flex items-center justify-center bg-blue-700 border border-black font-bold" style="width: 300px; height: 40px;">FACULTY TABLE</div>
            </div>
        </div>
    </div>

    <div class="w-full mb-6"></div>

    @php
        $totalSeats = count($seatplansArray);
        $halfSeats = ceil($totalSeats / 2);
        $firstHalf = array_slice($seatplansArray, 0, $halfSeats, true);
        $secondHalf = array_slice($seatplansArray, $halfSeats, null, true);
    @endphp

    <div class="flex gap-20 justify-center">
        <div class="w-1/2">
            <table class="table table-zebra">
                <thead>
                    <tr class="bg-base-200 rounded-md">
                        <th>SEAT</th>
                        <th>NAME</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($firstHalf as $seatNumber => $student)
                        <tr>
                            <td>{{ $seatNumber }}</td>
                            <td>
                                {{ $student['first_name'] }} {{ $student['last_name'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="w-1/2">
            <table class="table table-zebra">
                <thead>
                    <tr class="bg-base-200 rounded-md">
                        <th>SEAT</th>
                        <th>NAME</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($secondHalf as $seatNumber => $student)
                        <tr>
                            <td>{{ $seatNumber }}</td>
                            <td>
                                {{ $student['first_name'] }} {{ $student['last_name'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
