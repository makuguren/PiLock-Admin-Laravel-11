<div wire:poll.1s>
    @include('admin.settings.modals.trunattendances')
    @include('admin.settings.modals.truncourses')
    @include('admin.settings.modals.trunenrolled')
    @include('admin.settings.modals.truninst')
    @include('admin.settings.modals.trunlogs')
    @include('admin.settings.modals.trunscheds')
    @include('admin.settings.modals.trunseatplan')
    @include('admin.settings.modals.trunsections')
    @include('admin.settings.modals.trunstudents')

    {{-- Archived Data Modal --}}
    @include('admin.settings.modals.archived')
    @include('admin.settings.modals.execute')

    <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
        <div class="flex items-start justify-between mb-4">
            <div class="font-medium">Database Configuration</div>
        </div>

        <div class="grid grid-cols-1 gap-2 mb-6 lg:grid-cols-4">
            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunattendances_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Attendances
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunenrolled_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate EnrolledCourses
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunscheds_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Schedules
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunlogs_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Logs
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunseatplan_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Seat Plan
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="truncourses_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Courses
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunstudents_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Students
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="truninst_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Instructors
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label for="trunsections_modal" class="text-white bg-red-700 btn hover:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Sections
                </label>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
        <div class="p-6 mt-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
            <div class="flex items-start justify-between mb-4">
                <div class="font-medium">Switches</div>
            </div>

            <div class="grid grid-cols-1 gap-2 mb-6 lg:grid-cols-2">

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Maintenance Mode</span>
                    <input type="checkbox" wire:model="isMaintenance" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Device Integration</span>
                    <input type="checkbox" wire:model="isDevInteg" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Register Students Via Google</span>
                    <input type="checkbox" wire:model="isRegStud" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Login/Register Students</span>
                    <input type="checkbox" wire:model="isRegLoginStud" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Register Instructors</span>
                    <input type="checkbox" wire:model="isRegInst" class="checkbox checkbox-primary" />
                    </label>
                </div>

                {{-- Code Here --}}
                <div class="form-control">
                    <label class="cursor-pointer label">
                    <span class="label-text">Enable Register Admins</span>
                    <input type="checkbox" wire:model="isRegAdmins" class="checkbox checkbox-primary" />
                    </label>
                </div>
            </div>
        </div>

        <div class="p-6 mt-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
            <div class="flex items-start justify-between mb-4">
                <div class="font-medium">Website Configuration</div>
            </div>

            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Archived Data</h3>
                    <p class="text-sm text-gray-600">Archived Data for Students and Faculties and other Configurations.</p>
                </div>
                <label for="archived_modal" class="text-white bg-red-700 btn hover:bg-red-500">Archived Data</label>
            </div>

            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Laboratory Seats</h3>
                    <p class="text-sm text-gray-600">Laboratory Seats in MAC Laboratory.</p>
                </div>
                <label for="archived_modal" class="text-white bg-blue-700 btn hover:bg-blue-500">Configure</label>
            </div>

            {{-- <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Tagline</h3>
                    <p class="text-sm text-gray-600">Brief description or slogan for your website</p>
                </div>
                <button class="btn btn-primary">Edit</button>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Site Icon</h3>
                    <p class="text-sm text-gray-600">Upload a small image to be shown as favicon</p>
                </div>
                <button class="btn btn-primary">Upload</button>
            </div> --}}
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('trunattendances_modal').checked = false;
            document.getElementById('trunenrolled_modal').checked = false;
            document.getElementById('trunscheds_modal').checked = false;
            document.getElementById('trunseatplan_modal').checked = false;
            document.getElementById('truncourses_modal').checked = false;
            document.getElementById('trunstudents_modal').checked = false;
            document.getElementById('truninst_modal').checked = false;
            document.getElementById('trunsections_modal').checked = false;
            document.getElementById('trunlogs_modal').checked = false;
            document.getElementById('execute_modal').checked = false;
        });

        function cancel_truncate(){
            document.getElementById('trunattendances_modal').checked = false;
            document.getElementById('trunenrolled_modal').checked = false;
            document.getElementById('trunscheds_modal').checked = false;
            document.getElementById('trunseatplan_modal').checked = false;
            document.getElementById('truncourses_modal').checked = false;
            document.getElementById('trunstudents_modal').checked = false;
            document.getElementById('truninst_modal').checked = false;
            document.getElementById('trunsections_modal').checked = false;
            document.getElementById('trunlogs_modal').checked = false;
        }

        function cancel_archive(){
            document.getElementById('archived_modal').checked = false;
        }

        function executeModal(){
            document.getElementById('execute_modal').checked = true;
        }
    </script>
</x-slot>
