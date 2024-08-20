<x-admin-app-layout>

    <x-slot:title>Add Permission to Role {{ $role->name }}</x-slot:title>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Role: {{ $role->name }}</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="{{ route('admin.dashboard.index') }}" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <a href="{{ route('admin.roles.index') }}" class="text-gray-400 hover:text-gray-600 mr-2 font-medium">Roles</a>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Role: {{ $role->name }}</li>
                </ul>
            </div>
            <a href="{{ route('admin.roles.index') }}" class="btn bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-white text-sm">Cancel</span>
            </a>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            {{-- Code Here --}}

            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Permissions</div>
            </div>

            <form action="{{ route('admin.roles.givepermission', $role->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 p-2 mb-6">

                    @foreach ($permissions as $permission)
                        <div class="form-control col-md-2">
                            <label class="cursor-pointer label">
                            <span class="label-text">{{ $permission->name }}</span>
                            <input type="checkbox" value="{{ $permission->name }}" name="permission[]" class="checkbox checkbox-accent" {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }} />
                            </label>
                        </div>
                    @endforeach

                </div>
                <div class="flex flex-row-reverse">
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 btn-ml mt-5 w-32">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-white text-sm">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>
