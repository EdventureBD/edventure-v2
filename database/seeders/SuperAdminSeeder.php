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
use App\Models\Admin\ContentTag;
use App\Models\Admin\CourseLecture;
use App\Models\Admin\CourseCategory;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->where('email','admin@app.com')->first();

        $role = Role::query()->create(['name' => 'Super Admin']);

        $user->assignRole($role);
    }
}
