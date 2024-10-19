<x-slot:title>
    Archives
</x:slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Archives</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Archives</li>
                </ul>
            </div>

            {{-- <label for="add_modal" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M9 15h6"/><path d="M12 18v-6"/></svg>
                <span class="text-sm text-white">Add Archive</span>
            </label> --}}

            <button wire:click="createSnapshot('first_db_dump')" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M9 15h6"/><path d="M12 18v-6"/></svg>
                <span class="text-sm text-white">Add Snapshots</span>
            </button>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>SEMESTER</th>
                            <th>ACADEMIC YEAR</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($archives as $archive)
                        <tr>
                            <td><div class="font-bold">{{ $archive->id }}</div></td>
                            <td><div class="">{{ $archive->snapshot_name }}</div></td>
                            <td><div class="">{{ $archive->semester }} Semester</div></td>
                            <td><div class="">{{ $archive->academic_year }}</div></td>
                            <td><div class="">{{ $archive->status == '0' ? 'Inactive' : 'Active' }}</div></td>
                            <th>
                                <div class="flex flex-row space-x-2">
                                    @if ($archive->status == '0')
                                        <label for="activate_archive" wire:click="activateArchive({{ $archive->id }})" class="h-8 bg-green-700 btn btn-ghost hover:bg-green-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                            <span class="text-sm text-white">Activate</span>
                                        </label>
                                    @elseif($archive->status == '1')
                                        <label for="activate_archive" wire:click="deactivateArchive({{ $archive->id }})" class="h-8 bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                            <span class="text-sm text-white">Deactivate</span>
                                        </label>                                        
                                    @endif
                                </div>
                            </th>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Archives Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{ $archives->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
