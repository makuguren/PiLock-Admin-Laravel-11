<input type="checkbox" id="archived_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="modal-box w-11/12 max-w-4xl">
        <div class="sticky top-0 bg-base-100">
            <h3 class="text-lg font-bold mb-4">Archived Data</h3>
            <button onclick="cancel_archive()" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-0">✕</button>
        </div>

        {{-- Content goes here! --}}
        <div class="flex flex-col space-y-4">
            @forelse ($archives as $archive)
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-md font-semibold">{{ $archive->snapshot_name }}</h4>
                        <p class="text-sm text-gray-600">{{ $archive->semester }} Semester A/Y {{ $archive->academic_year }}</p>
                    </div>
                    <div>
                        @if ($archive->status == '0')
                            <button wire:click="activateArchive({{ $archive->id }})" onclick="executeModal()" class="btn bg-blue-700 text-white hover:bg-blue-500">Activate</button>
                        @elseif ($archive->status == '1')
                            <button wire:click="deactivateArchive({{ $archive->id }})" onclick="executeModal()" class="btn bg-red-700 text-white hover:bg-red-500">Deactivate</button>
                            <a href="{{ route('archive.admin.login') }}" class="btn bg-green-700 text-white hover:bg-green-500">Open Archive Data</a>
                        @endif
                    </div>
                </div>            
            @empty
                No Archive Data Found
            @endforelse
        </div>
    </div>
</div>
