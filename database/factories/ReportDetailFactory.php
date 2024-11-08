<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Report;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportDetail>
 */
class ReportDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $admin = null;
        $content = null;
        $response = null;
        if(rand(0, 1) == 1){
            $admin = Admin::factory();
            $content = fake()->realText();
            $response = now();
        }
        // $files = File::allFiles('D:\Tugas Viko\Universitas Sanata Dharma\Semester 4\Lomba Gamma Fest\gammafest24\Train');
        return [
            'report_id' => Report::factory(),
            'content_of_report' => fake()->realText(),
            'admin_id' => Admin::factory(),
            'content_of_response'=>$content,
            // 'img' => file_get_contents(Arr::random([1,2,3,4,5,6,7,8,9,10])),
            'img' => (Arr::random([1,2,3,4,5,6,7,8,9,10])),
            'respose_time' => $response
        ];
    }
}
