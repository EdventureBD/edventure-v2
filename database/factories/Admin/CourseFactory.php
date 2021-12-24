<?php

namespace Database\Factories\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->word();
        $slug = $this->faker->slug;
        $categoryId = $this->faker->numberBetween($min = 1, $max = 8);
        $price = $this->faker->numberBetween($min = 1000, $max = 3000);
        $duration = $this->faker->numberBetween($min = 1, $max = 36);
        return [
            'title' => $title,
            'slug' => $slug,
            'course_category_id' => $categoryId,
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'price' => $price,
            'duration' => $duration,
            'status' => 1,
            'order' => 0
        ];
    }
}
