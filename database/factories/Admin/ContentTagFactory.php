<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\ContentTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContentTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->word();
        $slug = (string) Str::uuid();
        $courseId = $this->faker->numberBetween($min = 1, $max = 7);
        $courseTopic = $this->faker->numberBetween($min = 1, $max = 20);
        $courseLecture = $this->faker->numberBetween($min = 1, $max = 20);
        return [
            'title' => $title,
            'slug' => $slug,
            'course_id' => $courseId,
            'topic_id' => $courseTopic,
            'lecture_id' => $courseLecture,
            'status' => 1
        ];
    }
}
