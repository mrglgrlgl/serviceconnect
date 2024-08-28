<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceRequest;
use App\Models\User; // Assuming User model is used for seekers

class ServiceRequestSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 20) as $index) {
            ServiceRequest::create([
                'category' => 'Plumbing',
                'title' => "Sample Request $index",
                'description' => "This is a sample description for request $index.",
                'location' => '123 Example St',
                'start_date' => now()->toDateString(),
                'end_date' => now()->addDays(10)->toDateString(),
                'start_time' => now()->toTimeString(),
                'end_time' => now()->addHours(2)->toTimeString(),
                'skill_tags' => 'example',
                'provider_gender' => 'female', // Ensure this matches the enum
                'job_type' => 'hourly_rate', // Ensure this matches the enum
                'estimated_duration' => 2,
                'number_of_bids' => 0,
                'user_id' => 95, // Set user_id to 95
                'provider_id' => null, // Or a valid provider ID if necessary
                'is_direct_hire' => 0,
                'status' => 'open',
                'agreed_to_terms' => 0,
                'min_price' => 0.0,
            ]);
        }
    }



    private function getRandomCategory()
    {
        $categories = ['Plumbing', 'Electrical', 'Cleaning', 'Gardening', 'Carpentry'];
        return $categories[array_rand($categories)];
    }

    private function getRandomLocation()
    {
        $locations = ['123 Main St, Anytown, USA', '456 Elm St, Othertown, USA', '789 Maple Ave, Newtown, USA'];
        return $locations[array_rand($locations)];
    }

    private function getRandomGender()
    {
        $genders = ['male', 'female', null];
        return $genders[array_rand($genders)];
    }

    private function getRandomJobType()
    {
        $jobTypes = ['project_based', 'hourly_rate']; // Match your ENUM values
        return $jobTypes[array_rand($jobTypes)];
    }

    private function getRandomStatus()
    {
        $statuses = ['open', 'in_progress', 'completed', 'cancelled'];
        return $statuses[array_rand($statuses)];
    }
}
