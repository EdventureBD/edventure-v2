<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\CourseLecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseLectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseLecture::class;

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
        $courseTopic = $this->faker->numberBetween($min = 1, $max = 20);
        $url = $this->faker->numberBetween($min = 1000, $max = 9999999);
        return [
            'title' => $title,
            'slug' => $slug,
            'course_id' => $courseId,
            'topic_id' => $courseTopic,
            'url' => $url,
            'status' => 1,
            'order' => 0
        ];
    }
}
