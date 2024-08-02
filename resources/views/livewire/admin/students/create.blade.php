<x-admin-app-layout>

    <x-slot:title>
        Create Student
    </x-slot>

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Create Student</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="{{ route('admin.students.index') }}" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <a href="{{ route('admin.students.index') }}" class="text-gray-400 hover:text-gray-600 mr-2 font-medium">Students</a>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Create Student</li>
                </ul>
            </div>
            <a href="{{ route('admin.students.index') }}" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
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
            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="flex flex-wrap mb-3">
                    <div class="w-full px-3">
                        <label class="label-text">Student ID</label>
                        <input class="input input-bordered bg-base-300 block w-full py-3 px-4 mb-3" name="student_id" type="text" placeholder="">
                        @error('student_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full px-3">
                        <label class="label-text" for="grid-name">Name</label>
                        <input class="input input-bordered w-full bg-base-300" name="name" type="text" placeholder="">
                        @error('name')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                        <label class="label-text" for="grid-birthdate">Birthdate</label>
                        <input class="input input-bordered w-full bg-base-300" name="birthdate" type="date" placeholder="">
                        @error('birthdate')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="label-text" for="">Section</label>
                        <select class="select select-bordered w-full bg-base-300" name="section_id">
                            <option>--Select your Section--</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')<small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="label-text" for="grid-email">Email</label>
                        <input class="input input-bordered w-full bg-base-300" name="email" type="email" placeholder="">
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        <span class="text-white text-sm">Save</span>
                    </button>
                </div>
                {{-- <div class="flex flex-wrap mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                            City
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-city" type="text" placeholder="Albuquerque">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                            State
                        </label>
                        <div class="relative">
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option>New Mexico</option>
                                <option>Missouri</option>
                                <option>Texas</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                            Zip
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-zip" type="text" placeholder="90210">
                    </div>
                </div> --}}
            </form>
        </div>
    </div>

</x-admin-app-layout>
