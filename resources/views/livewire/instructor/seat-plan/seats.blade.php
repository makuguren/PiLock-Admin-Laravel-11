<div wire:poll.1s class="flex items-center justify-center">
    <div class="grid grid-cols-2 gap-2 p-10 text-white">
        @php
            // $seatplan = [ // 0 = Spacing, 1-40 are Number of Seats
            //       [0, 0, 40, 39, 38, 37, 0], [0, 36, 35, 0, 0, 0, 0],
            //     [23, 24, 25, 26, 27, 28, 0], [0, 29, 30, 31, 32, 33, 34],
            //     [22, 21, 20, 19, 18, 17, 0], [0, 16, 15, 14, 13, 12, 11],
            //                 [1, 2, 3, 4, 5], [0, 6, 7, 8, 9, 10, 0],
            // ];

            // Create an associative array keyed by seat number for easy access
            // $seatplansArray = $seatplans->keyBy('seat_number')->toArray(); (This is the old code)
            $seatplan = \App\Models\SeatConfiguration::all()->groupBy('row');
            $seatplansArray = $seatplans->pluck('seatplan')->flatten()->keyBy('seat_number')->toArray();
        @endphp

        @foreach ($seatplan as $row)
            <div class="flex justify-center">
                @foreach ($row as $seat)
                    @if ($seat->seat_number === 0)
                        <div class="flex items-center justify-center w-12 h-12 m-1 tooltip"></div>
                    @elseif (!isset($seatplansArray[$seat->seat_number]))
                        <div id="{{ $seat->seat_number }}" ondrop="drop(event)" ondragover="allowDrop(event)" class="flex items-center justify-center w-12 h-12 m-1 bg-blue-700 border border-black box">{{ $seat->seat_number }}</div>
                    @else
                        <div wire:click="viewSeat({{ $seatplansArray[$seat->seat_number]['id'] }})" id="{{ $seat->seat_number }}" ondrop="drop(event)" ondragover="allowDrop(event)" class="flex items-center justify-center w-12 h-12 m-1 bg-red-700 border border-black box tooltip" data-tip="{{ $seatplansArray[$seat->seat_number]['student']['first_name'] ?? '' }} {{ $seatplansArray[$seat->seat_number]['student']['last_name'] ?? '' }}">{{ $seat->seat_number }}</div>
                    @endif
                @endforeach
            </div>
        @endforeach

        <div class="flex justify-center col-span-2 mt-5">
            <div class="flex items-center justify-center h-12 bg-blue-700 border border-black w-72">INSTRUCTORS TABLE</div>
        </div>
    </div>
</div>
