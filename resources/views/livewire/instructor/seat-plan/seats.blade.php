<div wire:poll.1s class="flex justify-center items-center">
    <div class="grid grid-cols-2 gap-2 p-10 text-white">
        @php
            $seatplan = [ // 0 = Spacing, 1-40 are Number of Seats
                  [0, 0, 40, 39, 38, 37, 0], [0, 36, 35, 0, 0, 0, 0],
                [23, 24, 25, 26, 27, 28, 0], [0, 29, 30, 31, 32, 33, 34],
                [22, 21, 20, 19, 18, 17, 0], [0, 16, 15, 14, 13, 12, 11],
                            [1, 2, 3, 4, 5], [0, 6, 7, 8, 9, 10, 0],
            ];

            // Create an associative array keyed by seat number for easy access
            // $seatplansArray = $seatplans->keyBy('seat_number')->toArray(); (This is the old code)
            $seatplansArray = $seatplans->pluck('seatplan')->flatten()->keyBy('seat_number')->toArray();
        @endphp

        @foreach ($seatplan as $row)
            <div class="flex justify-center">
                @foreach ($row as $seat)
                    @if ($seat === 0)
                        <div class="tooltip w-12 h-12 flex justify-center items-center m-1"></div>
                    @elseif (!isset($seatplansArray[$seat]))
                        <div id="{{ $seat }}" ondrop="drop(event)" ondragover="allowDrop(event)" class="box w-12 h-12 flex justify-center items-center m-1 border border-black bg-blue-700">{{ $seat }}</div>
                    @else
                        <div wire:click="viewSeat({{ $seatplansArray[$seat]['id'] }})" id="{{ $seat }}" ondrop="drop(event)" ondragover="allowDrop(event)" class="box tooltip w-12 h-12 flex justify-center items-center m-1 border border-black bg-red-700" data-tip="{{ $seatplansArray[$seat]['student']['first_name'] ?? '' }} {{ $seatplansArray[$seat]['student']['last_name'] ?? '' }}">{{ $seat }}</div>
                    @endif
                @endforeach
            </div>
        @endforeach

        <div class="col-span-2 flex justify-center mt-5">
            <div class="w-72 h-12 flex justify-center items-center border border-black bg-blue-700">INSTRUCTORS TABLE</div>
        </div>
    </div>
</div>
