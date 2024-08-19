<x-admin-app-layout>

    <x-slot:title>
        Edit Students
    </x-slot>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Edit Student</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="{{ route('admin.students.index') }}" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <a href="{{ route('admin.students.index') }}" class="text-gray-400 hover:text-gray-600 mr-2 font-medium">Students</a>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Edit Student</li>
                </ul>
            </div>
            <a href="{{ route('admin.students.index') }}" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-white">Cancel</span>
            </a>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            {{-- Code Here --}}
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @method('PUT')
                @csrf
                <div class="flex flex-wrap mb-3">
                    <div class="w-full px-3">
                        <label class="label-text">Student ID</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="student_id" value="{{ $student->student_id }}" type="text" placeholder="">
                        @error('student_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text" for="grid-name">Name</label>
                        <input class="input input-bordered w-full bg-base-300" name="name" value="{{ $student->name }}" type="text" placeholder="">
                        @error('name')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full md:w-1/3 px-3">
                        <label class="label-text" for="">Section</label>
                        <select class="select select-bordered w-full bg-base-300" name="section_id">
                            <option>--Select your Section--</option>
                            @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ $section->id == $student->section_id ? 'Selected':'' }}>{{ $section->program }} {{ $section->year }}{{ $section->block }}</option>
                            @endforeach
                        </select>
                        @error('section_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3">
                        <label class="label-text" for="">Gender</label>
                        <select class="select select-bordered w-full bg-base-300" name="gender">
                            <option>--Select Gender--</option>
                            <option value="1" {{ $student->gender == '1' ? 'Selected':'' }}>Male</option>
                            <option value="2" {{ $student->gender == '2' ? 'Selected':'' }}>Female</option>
                        </select>
                        @error('gender')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-3 md:mb-0">
                        <label class="label-text" for="grid-birthdate">Birthdate</label>
                        <input class="input input-bordered w-full bg-base-300" name="birthdate" value="{{ $student->birthdate }}" type="date" placeholder="">
                        @error('birthdate')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="label-text" for="grid-email">Email</label>
                        <input class="input input-bordered w-full bg-base-300" name="email" type="email" value="{{ $student->email }}" placeholder="">
                        @error('email')<small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="label-text" for="grid-password">Password</label>
                        <input class="input input-bordered w-full bg-base-300" name="password" type="password" placeholder="">
                        @error('password')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-row-reverse">
                    <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-ml mt-5 w-32">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        <span class="text-white text-sm">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-app-layout>
