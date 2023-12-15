<?php

namespace Database\Seeders;

use App\Models\Applicant\Brand;
use App\Models\Applicant\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $waiting = Status::create([
                'name' => 'Waiting',
                'message' => 'Pengajuan Hak atas Merk Anda sedang Proses Review.',
            ]);

            $accepted = Status::create([
                'name' => 'Accepted',
                'message' => 'Pengajuan Hak atas Merk Anda Telah Disetujui.',
            ]);
            
            $revision = Status::create([
                'name' => 'Revision',
                'message' => 'Pengajuan Hak atas Merk Anda Perlu Perbaikan.',
            ]);

            $rejected = Status::create([
                'name' => 'Rejected',
                'message' => 'Pengajuan Hak atas Merk Anda Ditolak.',
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
