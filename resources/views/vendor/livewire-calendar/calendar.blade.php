<div
    @if($pollMillis !== null && $pollAction !== null)
        wire:poll.{{ $pollMillis }}ms="{{ $pollAction }}"
    @elseif($pollMillis !== null)
        wire:poll.{{ $pollMillis }}ms
    @endif
>
    <div class="hidden lg:block">
        {{-- @includeIf($beforeCalendarView) --}}
        <div class="flex flex-column items-center">

            <div class="w-full">
                <p class="mb-3 font-medium text-lg">{{ $this->startsAt->format('M Y') }}</p>
            </div>

            <div class="flex flex-column gap-3 mb-3">
                <div class="btn bg-blue-700 hover:bg-blue-500 btn-sm">
                    <button wire:click="goToCurrentMonth" class="text-white">Current</button>
                </div>

                <div class="btn bg-red-700 hover:bg-red-500 btn-sm">
                    <button wire:click="goToPreviousMonth" class="text-white">Previous</button>
                </div>

                <div class="btn bg-blue-700 hover:bg-blue-500 btn-sm">
                    <button wire:click="goToNextMonth" class="text-white">Next</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Responsive Card Header --}}
    <div class="lg:hidden">
        {{-- @includeIf($beforeCalendarView) --}}
        <div class="items-center">

            <div class="w-full">
                <p class="mb-3 font-medium text-lg">{{ $this->startsAt->format('M Y') }}</p>
            </div>

            <div class="flex flex-column gap-3 mb-3">
                <div class="btn bg-blue-700 hover:bg-blue-500 btn-sm">
                    <button wire:click="goToCurrentMonth" class="text-white">Current</button>
                </div>

                <div class="btn bg-red-700 hover:bg-red-500 btn-sm">
                    <button wire:click="goToPreviousMonth" class="text-white">Previous</button>
                </div>

                <div class="btn bg-blue-700 hover:bg-blue-500 btn-sm">
                    <button wire:click="goToNextMonth" class="text-white">Next</button>
                </div>
            </div>
        </div>
    </div>


    <div class="flex">
        <div class="overflow-x-auto w-full">
            <div class="inline-block min-w-full overflow-hidden">

                <div class="w-full flex flex-row">
                    @foreach($monthGrid->first() as $day)
                        @include($dayOfWeekView, ['day' => $day])
                    @endforeach
                </div>

                @foreach($monthGrid as $week)
                    <div class="w-full flex flex-row">
                        @foreach($week as $day)
                            @include($dayView, [
                                    'componentId' => $componentId,
                                    'day' => $day,
                                    'dayInMonth' => $day->isSameMonth($startsAt),
                                    'isToday' => $day->isToday(),
                                    'events' => $getEventsForDay($day, $events),
                                ])
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        {{-- @includeIf($afterCalendarView) --}}
    </div>
</div>
