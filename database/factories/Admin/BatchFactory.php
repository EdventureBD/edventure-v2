<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Batch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->word();
        $slug = $this->faker->slug;
        $courseId = $this->faker->numberBetween($min = 1, $max = 20);
        return [
            'title' => $title,
            'slug' => $slug,
            'batch_running_days' => 1,
            'teacher_id' => $this->faker->randomElement($array = array(2, 5, 9, 12, 13, 14)),
            'student_limit' => $this->faker->numberBetween($min = 40, $max = 60),
            'course_id' => $courseId,
            'status' => 1,
            'order' => 0
        ];
    }
}
