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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        <span class="text-white text-sm">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>
