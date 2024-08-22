<div wire:poll.1s>
    <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="flex justify-between mb-4 items-start">
            <div class="font-medium">Database Configuration</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-2 mb-6">
            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateAttendances" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Attendances
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateEnrolledCourses" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate EnrolledCourses
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateScheds" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Schedules
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateLogs" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Logs
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateSeatPlan" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Seat Plan
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateCourses" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Courses
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateStudents" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Students
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateInstructors" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Instructors
                </button>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <button wire:click="truncateSections" class="btn bg-red-700 hover:bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Truncate Sections
                </button>
            </div>
        </div>
    </div>

    <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md mt-6">
        <div class="flex justify-between mb-4 items-start">
            <div class="font-medium">Switches</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mb-6">

            {{-- Code Here --}}
            <div class="form-control">
                <label class="label cursor-pointer">
                <span class="label-text">Maintenance Mode</span>
                <input type="checkbox" wire:model="isMaintenance" class="checkbox checkbox-primary" />
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label class="label cursor-pointer">
                <span class="label-text">Enable Device Integration</span>
                <input type="checkbox" wire:model="isDevInteg" class="checkbox checkbox-primary" />
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label class="label cursor-pointer">
                <span class="label-text">Enable Register Students Via Google</span>
                <input type="checkbox" wire:model="isRegStud" class="checkbox checkbox-primary" />
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label class="label cursor-pointer">
                <span class="label-text">Enable Login/Register Students</span>
                <input type="checkbox" wire:model="isRegLoginStud" class="checkbox checkbox-primary" />
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label class="label cursor-pointer">
                <span class="label-text">Enable Register Instructors</span>
                <input type="checkbox" wire:model="isRegInst" class="checkbox checkbox-primary" />
                </label>
            </div>

            {{-- Code Here --}}
            <div class="form-control">
                <label class="label cursor-pointer">
                <span class="label-text">Enable Register Admins</span>
                <input type="checkbox" wire:model="isRegAdmins" class="checkbox checkbox-primary" />
                </label>
            </div>
        </div>
    </div>
</div>
