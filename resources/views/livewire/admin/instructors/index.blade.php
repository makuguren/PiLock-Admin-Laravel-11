<x-slot:title>
    Instructors
</x-slot>

<div>
    {{-- Instructors Modal --}}
    @can('Create Instructors')
        @include('livewire.admin.instructors.create')
    @endcan
    @can('Update Instructors')
        @include('livewire.admin.instructors.edit')
    @endcan
    @can('Delete Instructors')
        @include('livewire.admin.instructors.delete')
    @endcan

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Instructors</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Instructors</li>
                </ul>
            </div>
            @can('Add Tag UID to Instructors')
            <a href="{{ route('admin.instructors.addtaguid') }}" class="btn btn-ghost bg-green-700 hover:bg-green-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                <span class="text-white text-sm">Add Tag UID</span>
            </a>
            @endcan
            @can('Create Instructors')
            <label for="add_modal" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-pen"><path d="M11.5 15H7a4 4 0 0 0-4 4v2"/><path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><circle cx="10" cy="7" r="4"/></svg>
                <span class="text-white text-sm">Add Instructor</span>
            </label>
            @endcan
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>ID</th>
                            <th>TAG UID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($instructors as $instructor)
                        <tr>
                            <td><div class="font-bold">{{ $instructor->id }}</div></td>
                            <td>
                                <div class="">
                                    @if ($instructor->tag_uid)
                                        {{ $instructor->tag_uid }}
                                    @else
                                        No UID Assigned
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $instructor->name }}</div></td>
                            <td><div class="">{{ $instructor->email }}</div></td>
                            <th>
                                <div class="flex flex-row space-x-2">
                                    @can('Update Instructors')
                                    <label for="edit_modal" wire:click="editInstructor({{ $instructor->id }})" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-sm h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                        <span class="text-white text-sm">Edit</span>
                                    </label>
                                    @endcan

                                    @can('Delete Instructors')
                                    <label for="delete_modal" wire:click="deleteInstructor({{ $instructor->id }})" class="btn btn-ghost bg-red-700 hover:bg-red-500 btn-sm h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        <span class="text-white text-sm">Delete</span>
                                    </label>
                                    @endcan
                                </div>
                            </th>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Instructors Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $instructors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('add_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;
        });

        function cancel_inst(){
            document.getElementById('add_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;

            //Clear all the Values in Text Inputs (Instructors)
            document.getElementById('addinst_name').value = '';
            document.getElementById('addinst_email').value = '';
            document.getElementById('addinst_password').value = '';

            // document.getElementById('editinst_name').value = '';
            // document.getElementById('editinst_email').value = '';
        }
    </script>
</x-slot:scripts>
