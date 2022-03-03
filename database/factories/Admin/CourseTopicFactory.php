<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\CourseTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseTopic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->word();
        $slug = $this->faker->slug;
        $courseId = $this->faker->numberBetween($min = 1, $max = 7);
        return [
            'title' => $title,
            'slug' => $slug,
            'course_id' => $courseId,
            'status' => 1,
            'order' => 0
        ];
    }
}
