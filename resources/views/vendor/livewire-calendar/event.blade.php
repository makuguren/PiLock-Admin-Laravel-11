<div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id']  }}')"
    @endif
    class="bg-blue-700 rounded-lg border py-2 px-3 shadow-md cursor-pointer">

    <p class="text-sm text-gray-200 font-medium">
        {{ $event['title'] }}
    </p>
    <p class="mt-2 text-xs text-gray-300">
        Time: {{ $event['event_start'] }} - {{ $event['event_end'] }}
    </p>
</div>
