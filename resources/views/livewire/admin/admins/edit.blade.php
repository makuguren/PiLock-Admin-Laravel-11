<x-admin-app-layout>

    <x-slot:title>Edit Admin</x-slot:title>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Edit Admin</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="{{ route('admin.dashboard.index') }}" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <a href="{{ route('admin.admins.index') }}" class="text-gray-400 hover:text-gray-600 mr-2 font-medium">Admins</a>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Edit Admin</li>
                </ul>
            </div>
            <a href="{{ route('admin.admins.index') }}" class="btn bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
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
            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap mb-2">
                    <div class="w-full px-3">
                        <label class="label-text">Name</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="name" value="{{ $admin->name }}" type="text" placeholder="">
                        @error('name')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-2">
                    <div class="w-full px-3">
                        <label class="label-text">Email</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="email" readonly value="{{ $admin->email }}" type="email" placeholder="">
                        @error('email')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-2">
                    <div class="w-full px-3">
                        <label class="label-text">Password</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="password" type="password" placeholder="">
                        @error('password')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text" for="">Role</label>

                        <select class="select select-bordered w-full bg-base-300" name="roles[]">
                            <option>--Select Role--</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected':'' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-row-reverse">
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 btn-ml mt-5 w-32">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        <span class="text-white text-sm">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>