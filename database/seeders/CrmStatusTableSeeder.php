<?php

namespace Database\Seeders;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Lead',
                'created_at' => '2020-10-03 15:42:19',
                'updated_at' => '2020-10-03 15:42:19',
            ],
            [
                'id'         => 2,
                'name'       => 'Customer',
                'created_at' => '2020-10-03 15:42:19',
                'updated_at' => '2020-10-03 15:42:19',
            ],
            [
                'id'         => 3,
                'name'       => 'Partner',
                'created_at' => '2020-10-03 15:42:19',
                'updated_at' => '2020-10-03 15:42:19',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
