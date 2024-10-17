<x-admin-app-layout>

    <x-slot:title>
        Create Student
    </x-slot>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Create Student</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="{{ route('admin.students.index') }}" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <a href="{{ route('admin.students.index') }}" class="mr-2 font-medium text-gray-400 hover:text-gray-600">Students</a>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <li class="mr-2 font-medium text-gray-600">Create Student</li>
                </ul>
            </div>
            <a wire:navigate.hover href="{{ route('admin.students.index') }}" class="mt-3 bg-red-700 btn btn-ghost hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-sm text-white">Cancel</span>
            </a>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            {{-- Code Here --}}
            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text">Student ID</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300" name="student_id" type="text" placeholder="">
                        @error('student_id')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-4 md:mb-3">
                    <div class="w-full px-3 mb-4 md:w-1/2">
                        <label class="label-text">First Name</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300" name="first_name" type="text" placeholder="">
                        @error('first_name')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>

                    <div class="w-full px-3 md:w-1/2">
                        <label class="label-text">Last Name</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300" name="last_name" type="text" placeholder="">
                        @error('last_name')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-1 md:mb-6">
                    <div class="w-full px-3 mb-4 md:w-1/2 md:mb-0">
                        <label class="label-text" for="">Section</label> <span class="text-red-600">*</span>
                        <select class="w-full px-4 py-3 mt-1 mb-1 select select-bordered bg-base-300" name="section_id">
                            <option>--Select your Section--</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->program }} {{ $section->year }}{{ $section->block }}</option>
                            @endforeach
                        </select>
                        @error('section_id')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>

                    <div class="w-full px-3 mb-4 md:w-1/2 md:mb-0">
                        <label class="label-text" for="">Gender</label> <span class="text-red-600">*</span>
                        <select class="w-full px-4 py-3 mt-1 mb-1 select select-bordered bg-base-300" name="gender">
                            <option>--Select Gender--</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gender')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3 mb-4 md:w-1/2 md:mb-0">
                        <label class="label-text" for="grid-email">Email</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300" name="email" type="email" placeholder="">
                        @error('email')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>

                    <div class="w-full px-3 mb-4 md:w-1/2 md:mb-0">
                        <label class="label-text" for="grid-password">Password</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-1 mb-1 input input-bordered bg-base-300" name="password" type="password" placeholder="">
                        @error('password')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-row-reverse">
                    <button type="submit" class="w-32 mt-5 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-ml">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-white">Save</span>
                    </button>
                </div>
                {{-- <div class="flex flex-wrap mb-2">
                    <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-city">
                            City
                        </label>
                        <input
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-city" type="text" placeholder="Albuquerque">
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-state">
                            State
                        </label>
                        <div class="relative">
                            <select
                                class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option>New Mexico</option>
                                <option>Missouri</option>
                                <option>Texas</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-zip">
                            Zip
                        </label>
                        <input
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-zip" type="text" placeholder="90210">
                    </div>
                </div> --}}
            </form>
        </div>
    </div>

</x-admin-app-layout>
