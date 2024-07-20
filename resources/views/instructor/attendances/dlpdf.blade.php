<input type="checkbox" id="download_pdf_modal" class="modal-toggle" />
<div dialog wire:ignore.self class="modal modal-bottom sm:modal-middle" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Download PDF</h3>
        <form wire:submit.prevent="downloadPDF" method="dialog" class="w-full mt-6">
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Section</label>
                    <select wire:model="dlpdfsection_id" id="selsection_id" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Sections--</option>
                            @foreach ($sections as $id => $section)
                                <option value="{{ $id }}">{{ $section }}</option>
                            @endforeach
                    </select>
                    @error('dlpdfsection_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Subject</label>
                    <select wire:model="dlpdfsubject_id" id="selsubject_id" class="select select-bordered bg-base-300 block w-full py-3 px-4 mb-3 form-control" required>
                        <option value="">--Select Subjects--</option>
                            @foreach ($subjects as $id => $subject)
                                <option value="{{ $id }}">{{ $subject }}</option>
                            @endforeach
                    </select>
                    @error('dlpdfsubject_id') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-wrap mb-2">
                <div class="w-full px-3">
                    <label class="label-text">Date</label>
                    <label class="flex items-center">
                        <input type="date" wire:model="dlpdfdate" id="dlpdfdate" class="input input-bordered block form-control w-full bg-base-300 text-sm" />
                    </label>
                    @error('dlpdfdate') <span class="error" role="alert">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-action">
                <div class="flex flex-row-reverse space-x-2 space-x-reverse">
                    <button type="submit" class="btn bg-blue-700 hover:bg-blue-500 text-white">Download</button>
                    <button onclick="cancel_dlpdf()" type="button" class="btn bg-red-700 hover:bg-red-500 text-white">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
