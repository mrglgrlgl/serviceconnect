<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $agencyId = 2; // Use the correct agency_id

        // Create multiple dummy employees
        for ($i = 1; $i <= 50; $i++) {
            Employee::create([
                'agency_id' => $agencyId,
                'name' => "Employee $i",
                'email' => "employee$i@example.com",
                'phone' => '555-555-5555',
                'position' => 'Position ' . $i,
                'gender' => $i % 2 == 0 ? 'Male' : 'Female',
                'birthdate' => now()->subYears(rand(20, 40))->format('Y-m-d'),
                'photo' => null, // or a path if you want to include a photo
            ]);
        }
    }
}
