<x-admin-app-layout>

    <x-slot:title>Create Admin</x-slot:title>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Create Admin</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="{{ route('admin.dashboard.index') }}" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <a href="{{ route('admin.admins.index') }}" class="mr-2 font-medium text-gray-400 hover:text-gray-600">Admins</a>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <li class="mr-2 font-medium text-gray-600">Create Admin</li>
                </ul>
            </div>
            <a href="{{ route('admin.admins.index') }}" class="mt-3 bg-red-700 btn hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-sm text-white">Cancel</span>
            </a>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            {{-- Code Here --}}
            <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3 md:w-1/2">
                        <label class="label-text">First Name</label>
                        <input class="block w-full px-5 py-4 mt-2 mb-2 input input-bordered bg-base-300" name="first_name" type="text" placeholder="">
                        @error('first_name')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="w-full px-3 md:w-1/2">
                        <label class="label-text">Last Name</label>
                        <input class="block w-full px-5 py-4 mt-2 mb-2 input input-bordered bg-base-300" name="last_name" type="text" placeholder="">
                        @error('last_name')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3">
                        <label class="label-text">Gender</label>
                        <select class="w-full mt-2 mb-2 select select-bordered bg-base-300" name="gender">
                            <option>--Select Gender--</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gender')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3 md:w-1/2">
                        <label class="label-text">Email</label>
                        <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="email" type="email" placeholder="">
                        @error('email')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="w-full px-3 md:w-1/2">
                        <label class="label-text">Password</label>
                        <input class="block w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="password" type="password" placeholder="">
                        @error('password')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text" for="">Role</label>

                        <select class="w-full mt-2 mb-2 select select-bordered bg-base-300" name="roles[]">
                            <option>--Select Role--</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-row-reverse">
                    <button type="submit" class="w-32 mt-5 bg-blue-700 btn hover:bg-blue-500 btn-ml">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-sm text-white">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>
