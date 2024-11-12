<?php

namespace App\Livewire\Admin\SeatsConfiguration;

use Livewire\Component;
use App\Models\SeatBackup;
use App\Models\SeatConfiguration;

class Index extends Component
{
    public $seatId, $seat_number, $row, $column, $name, $seatFilePath, $selectedSeatConfig;
    public $disableInptSeat = true,$disableBtnBlkAdd = true, $disableBtnAdd = true;

    // Validations
    protected function rules(){
        return [
            'seat_number' => 'required',
            'row' => 'required',
            'column' => 'required'
        ];
    }

    public function messages(){
        return [
            'seat_number.required' => 'Seat Number is Required',
            'row.required' => 'Row is Required',
            'column.required' => 'Column is Required'
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    // Validations End

    public function bulkaddSeats(){
        $validatedData = $this->validate([
            'row' => 'required',
            'column' => 'required'
        ]);

        $rows = $validatedData['row'];
        $columns = $validatedData['column'];
        $id = SeatConfiguration::max('id') + 1;

        foreach (range(1, $rows) as $r) {
            foreach (range(1, $columns) as $c) {
                SeatConfiguration::create([
                    'id' => $id,
                    'seat_number' => 0,
                    'row' => $r,
                    'column' => $c
                ]);
                $id++;
            }
        }

        // Fetch all SeatConfiguration data
        $allSeatConfigurations = SeatConfiguration::all();
        // Convert the data to JSON
        $jsonData = $allSeatConfigurations->toJson(JSON_PRETTY_PRINT);
        // Save JSON data to a file in the storage path
        file_put_contents(storage_path('app/seats_configuration.json'), $jsonData);

        $this->dispatch('disableButton');
        $this->disableBtnBlkAdd = true;

        toastr()->success('Bulk Seat Configuration Added Successfully');
        $this->resetInput();
    }

    public function saveSeatConfig(){
        $validatedData = $this->validate();

        SeatConfiguration::where('id', $this->seatId)->update([
            'seat_number' => $validatedData['seat_number'],
            'row' => $validatedData['row'],
            'column' => $validatedData['column']
        ]);

        $this->disableBtnAdd = true;
        $this->dispatch('configInptsDis');
        toastr()->success('Seat Configuration Added Successfully');
        $this->resetInput();
    }

    public function selectSeatConfig($id){
        $this->disableBtnAdd = false;

        $seat = SeatConfiguration::find($id);
        if($seat){
            $this->seatId = $seat->id;
            $this->seat_number = $seat->seat_number;
            $this->row = $seat->row;
            $this->column = $seat->column;
        } else {
            return redirect()->to('/seatsconfig');
        }
    }

    public function addSeatAuto($id){
        $seat = SeatConfiguration::find($id);

        // Get all seat numbers
        $allSeatNumbers = SeatConfiguration::pluck('seat_number')->toArray();
        $totalSeats = $seat->count();

        // Find the missing seat number
        $missingSeatNumber = null;
        foreach (range(1, $totalSeats) as $i) {
            if (!in_array($i, $allSeatNumbers)) {
                $missingSeatNumber = $i;
                break;
            }
        }

        // If no missing seat number is found, assign the next number
        if ($missingSeatNumber === null) {
            $missingSeatNumber = $totalSeats + 1;
        }

        // Update the seat_number with the missing seat number
        $seat->update(['seat_number' => $missingSeatNumber]);
    }

    public function exportConfiguration(){
        $validatedData = $this->validate([
            'name' => 'required'
        ]);

        // Fetch all SeatConfiguration data
        $allSeatConfigurations = SeatConfiguration::all();
        // Convert the data to JSON
        $jsonData = $allSeatConfigurations->toJson(JSON_PRETTY_PRINT);
        // Save JSON data to a file in the storage path
        $fileName = str_replace(' ', '-', $validatedData['name']) . '.json';
        $filepath = file_put_contents(storage_path('app/public/seats_configuration/' . $fileName), $jsonData);

        SeatBackup::create([
            'name' => $validatedData['name'],
            'filepath' => 'app/public/seats_configuration/' . $fileName
        ]);

        $this->resetInput([
            $this->name = ''
        ]);
        $this->dispatch('close-modal');
        toastr()->success('Export Data to JSON Successfully');
    }

    public function loadPreviewSeats($id){
        $seatbackup = SeatBackup::find($id);
        $this->seatFilePath = $seatbackup->filepath;
    }

    public function loadConfiguration(){

        $validatedData = $this->validate([
            'selectedSeatConfig' => 'required',
        ], [
            'selectedSeatConfig.required' => 'Please select a seat configuration to load.',
        ]);

        if(SeatConfiguration::exists()){
            SeatConfiguration::truncate();
        }

        $jsonData = json_decode(file_get_contents(storage_path($this->selectedSeatConfig)), true);
        foreach ($jsonData as $seat) {
            SeatConfiguration::create($seat);
        }
        $this->resetInput([
            $this->selectedSeatConfig = ''
        ]);
        $this->dispatch('close-modal');
        toastr()->success('Seat Configuration Loaded Successfully');
    }

    public function resetInput(){
        $this->seatId = '';
        $this->seat_number = '';
        $this->row = '';
        $this->column = '';
    }

    public function render(){
        $seatbackups = SeatBackup::all();
        $seatsConfig = SeatConfiguration::get();
        if($seatsConfig->isEmpty()){
            $this->disableBtnBlkAdd = false;
            $this->dispatch('configInptsEn');
        } else {
            $this->disableBtnBlkAdd = true;
            $this->disableInptSeat = false;
        }

        return view('livewire.admin.seats-configuration.index', [
            'seatbackups' => $seatbackups
        ])->layout('admin.layouts.secondapp');
    }
}
