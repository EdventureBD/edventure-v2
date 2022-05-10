<?php

namespace App\Enum;

interface UserType {
    const ADMIN = 1;
    const TEACHER = 2;
    const STUDENT = 3;

    const Exam = [
        '1' => 'Admin',
        '2' => 'Teacher',
        '3' => 'Student'
    ];
}
