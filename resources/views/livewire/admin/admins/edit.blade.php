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
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-white text-sm">Cancel</span>
            </a>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            {{-- Code Here --}}
            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap mb-3">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="label-text">First Name</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="first_name" value="{{ $admin->first_name }}" type="text" placeholder="">
                        @error('first_name')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label class="label-text">Last Name</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="last_name" value="{{ $admin->last_name }}" type="text" placeholder="">
                        @error('last_name')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3">
                        <label class="label-text">Gender</label>
                        <select class="select select-bordered w-full bg-base-300" name="gender">
                            <option>--Select Gender--</option>
                            <option value="1" {{ $admin->gender == '1' ? 'Selected':'' }}>Male</option>
                            <option value="2" {{ $admin->gender == '2' ? 'Selected':'' }}>Female</option>
                        </select>
                        @error('gender')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-3">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="label-text">Email</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="email" readonly value="{{ $admin->email }}" type="email" placeholder="">
                        @error('email')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-white text-sm">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>
