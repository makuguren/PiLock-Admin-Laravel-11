<div class="grid grid-cols-2 gap-2 p-10 text-white">
    @php
        $seatplan = json_decode(file_get_contents(storage_path('app/seats_configuration.json')), true);
        $seatplan = collect($seatplan)->groupBy('row');
    @endphp

    @foreach ($seatplan as $row)
        <div class="flex justify-center">
            @foreach ($row as $seat)
                @if ($seat['seat_number'] === 0)
                    <div wire:click="addSeatAuto({{ $seat['id'] }})" class="flex items-center justify-center w-12 h-12 m-1 border border-black box"></div>
                @else
                    <div wire:click="selectSeatConfig({{ $seat['id'] }})" id="{{ $seat['seat_number'] }}" ondrop="drop(event)" ondragover="allowDrop(event)" class="flex items-center justify-center w-12 h-12 m-1 bg-blue-700 border border-black box">{{ $seat['seat_number'] }}</div>
                @endif
            @endforeach
        </div>
    @endforeach

    <div class="flex justify-center col-span-2 mt-5">
        <div class="flex items-center justify-center h-12 bg-blue-700 border border-black w-72">INSTRUCTORS TABLE</div>
    </div>
</div>
