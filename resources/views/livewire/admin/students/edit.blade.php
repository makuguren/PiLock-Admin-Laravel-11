<x-admin-app-layout>

    <x-slot:title>
        Edit Students
    </x-slot>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Edit Student</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="{{ route('admin.students.index') }}" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <a href="{{ route('admin.students.index') }}" class="mr-2 font-medium text-gray-400 hover:text-gray-600">Students</a>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <li class="mr-2 font-medium text-gray-600">Edit Student</li>
                </ul>
            </div>
            <a wire:navigate.hover href="{{ route('admin.students.index') }}" class="mt-3 bg-red-700 btn btn-ghost hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-white">Cancel</span>
            </a>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            {{-- Code Here --}}
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @method('PUT')
                @csrf
                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text">Student ID</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="student_id" value="{{ $student->student_id }}" type="text" placeholder="">
                        @error('student_id')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-4 md:mb-3">
                    <div class="w-full px-3 mb-4 md:w-1/2">
                        <label class="label-text">First Name</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="first_name" value="{{ $student->first_name }}" type="text" placeholder="">
                        @error('first_name')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>

                    <div class="w-full px-3 md:w-1/2">
                        <label class="label-text">Last Name</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="last_name" value="{{ $student->last_name }}" type="text" placeholder="">
                        @error('last_name')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-1 md:mb-6">
                    <div class="w-full px-3 mb-4 md:w-1/2 md:mb-0">
                        <label class="label-text" for="">Section</label> <span class="text-red-600">*</span>
                        <select class="w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300" name="section_id">
                            <option>--Select your Section--</option>
                            @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ $section->id == $student->section_id ? 'Selected':'' }}>{{ $section->program }} {{ $section->year }}{{ $section->block }}</option>
                            @endforeach
                        </select>
                        @error('section_id')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>

                    <div class="w-full px-3 mb-4 md:w-1/2 md:mb-0">
                        <label class="label-text" for="">Gender</label> <span class="text-red-600">*</span>
                        <select class="w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300" name="gender">
                            <option>--Select Gender--</option>
                            <option value="1" {{ $student->gender == '1' ? 'Selected':'' }}>Male</option>
                            <option value="2" {{ $student->gender == '2' ? 'Selected':'' }}>Female</option>
                        </select>
                        @error('gender')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="label-text" for="grid-email">Email</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="email" type="email" value="{{ $student->email }}" placeholder="">
                        @error('email')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>

                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="label-text" for="grid-password">Password</label> <span class="text-red-600">*</span>
                        <input class="w-full px-4 py-3 mt-2 mb-2 input input-bordered bg-base-300" name="password" type="password" placeholder="">
                        @error('password')<span class="mt-1 space-y-1 text-sm text-red-600 error">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-row-reverse">
                    <button type="submit" class="w-32 mt-5 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-ml">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-sm text-white">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>
