<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use App\Models\Admin\Batch;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use Illuminate\Database\Seeder;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@app.com',
                'is_admin' => 1,
                'user_type' => 1,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@app.com',
                'is_admin' => 1,
                'user_type' => 1,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@app.com',
                'is_admin' => 0,
                'user_type' => 2,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Teacher2',
                'email' => 'teacher2@app.com',
                'is_admin' => 0,
                'user_type' => 2,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Student',
                'email' => 'student@app.com',
                'is_admin' => 0,
                'user_type' => 3,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Student2',
                'email' => 'student2@app.com',
                'is_admin' => 0,
                'user_type' => 3,
                'password' => Hash::make('password'),
            ]
        ];

        foreach ($user as $user) {
            User::create($user);
        }

        // User::factory(20)->create();
        // CourseCategory::factory()->count(20)->hasCourse(2)->create();


        // TOTAL->8
        // $course_category = [
        //     [
        //         'title' => 'ict',
        //         'slug' => 'ict',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'math',
        //         'slug' => 'math',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'engilsh',
        //         'slug' => 'engilsh',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'physics',
        //         'slug' => 'physics',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'chemistry',
        //         'slug' => 'chemistry',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'biology',
        //         'slug' => 'biology',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'grammer',
        //         'slug' => 'grammer',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'economics',
        //         'slug' => 'economics',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        // ];
        // foreach ($course_category as $course_category) {
        //     CourseCategory::create($course_category);
        // }
        // Course::factory(20)->create();
        // CourseTopic::factory(20)->create();
        // CourseLecture::factory(20)->create();
        // Batch::factory(20)->create();

        // $course = [
        //     [
        //         'title' => 'ict',
        //         'course_category_id' => 1,
        //         'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
        //         'price' => 1234,
        //         'slug' => 'ict',
        //         'duration' => '23',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'math',
        //         'course_category_id' => 2,
        //         'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
        //         'price' => 1234,
        //         'slug' => 'math',
        //         'duration' => '23',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'english',
        //         'course_category_id' => 3,
        //         'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
        //         'price' => 1234,
        //         'slug' => 'english',
        //         'duration' => '23',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'physics',
        //         'course_category_id' => 4,
        //         'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
        //         'price' => 1234,
        //         'slug' => 'physics',
        //         'duration' => '23',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        //     [
        //         'title' => 'chemistry',
        //         'course_category_id' => 5,
        //         'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
        //         'price' => 1234,
        //         'slug' => 'chemistry',
        //         'duration' => '23',
        //         'status' => 1,
        //         'order' => 0
        //     ],
        // ];
        // foreach ($course as $course) {
        //     Course::create($course);
        // }

        $user_types = [
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Teacher'
            ],
            [
                'name' => 'Student'
            ],
        ];

        foreach ($user_types as $user_type) {
            UserType::create($user_type);
        }
    }
}
