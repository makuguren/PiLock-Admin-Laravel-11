<input type="checkbox" id="download_pdf_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Export as PDF</h3>
        <form wire:submit.prevent="downloadPDF" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-4">
                <div class="w-full px-3">
                    <label class="label-text">Course and Sections</label> <span class="text-red-500">*</span>
                    <select wire:model="dlpdfcourse_id" id="selsection_id" class="block w-full px-4 py-3 mt-2 mb-2 select select-bordered bg-base-300 form-control" required>
                        <option value="">--Course and Section---</option>
                        @foreach($courseSecs as $courseSec)
                            <option value="{{ $courseSec->id }}">
                                {{ $courseSec->course_title ?? 'No Course Title' }} -
                                {{ $courseSec->section->program }}
                                {{ $courseSec->section->year }}{{ $courseSec->section->block }}
                            </option>
                        @endforeach
                    </select>
                    @error('dlpdfcourse_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
                    <label class="label-text">Date</label> <span class="text-red-500">*</span>
                    <label class="flex items-center">
                        <input type="date" wire:model="dlpdfdate" id="dlpdfdate" class="block w-full mt-2 mb-2 text-sm input input-bordered form-control bg-base-300" required />
                    </label>
                    @error('dlpdfdate') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Download
                    </button>
                    <button onclick="cancel_dlpdf()" type="button" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
