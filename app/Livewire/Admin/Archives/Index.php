<?php

namespace App\Livewire\Admin\Archives;

use App\Models\Archive;
use Livewire\Component;
use Illuminate\Support\Facades\Artisan;

class Index extends Component
{
    public function createSnapshot($dump_nane){
        $output = Artisan::call('snapshot:create', ['name' => $dump_nane]);

        if($output == 0){
            Archive::create([
                'snapshot_name' => 'First Dump 2024',
                'snapshot_data' => $dump_nane,
                'semester' => 'First',
                'academic_year' => '2024-2025',
                'status' => '0'
            ]);
            toastr()->success('Snapshot created successfully');
        } else {
            toastr()->error('Snapshot creation failed');
        }
    }

    public function activateArchive($archive_id){
        $archive = Archive::findOrFail($archive_id);

        if($archive){
            $output = Artisan::call('snapshot:load', [
                'name' => $archive->snapshot_data,
                '--connection' => 'mysql_archive'
            ]);

            if($output == '0'){
                $archive->update([
                    'status' => '1'
                ]);
                // $this->dispatch('close-modal');
                toastr()->success('Snapshot Activated Successfully');
            } else {
                // $this->dispatch('close-modal');
                toastr()->error('Snapshot Activation Failed');
            }
        }
    }

    public function deactivateArchive($archive_id){
        $archive = Archive::findOrFail($archive_id);

        if($archive){
            Artisan::call('migrate:rollback --database=mysql_archive');

            $archive->update([
                'status' => '0'
            ]);

            toastr()->success('Snapshot Deactivated and Rollback Migrations Successfully');

            // if($outputMigrate == '0'){
            //     dd($outputMigrate);

            //     $outputDel = Artisan::call('snapshot:delete', [
            //         'name' => $archive->snapshot_data,
            //     ]);

            //     if($outputDel == '0'){
            //         $archive->update([
            //             'status' => '0'
            //         ]);
            //     } else {
            //         toastr()->error('Snapshot Deactivation Failed');
            //     }
            //     toastr()->success('Snapshot Deactivated and Rollback Migrations Successfully');
            // } else {
            //     toastr()->error('Migration Rollback Failed');
            // }
        }
    }

    public function render(){
        $archives = Archive::all();
        return view('livewire.admin.archives.index', ['archives' => $archives]);
    }
}
