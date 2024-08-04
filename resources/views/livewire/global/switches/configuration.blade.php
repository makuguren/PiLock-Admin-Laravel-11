<div wire:poll.1s>
    <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
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
