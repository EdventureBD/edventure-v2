<?php

namespace App\Enum;

interface Permission {

    const List = [
        'user' => 'User Section',
        'role_permission' => 'Role & Permission',
        'other' => 'Other',
        'course' => 'Course Section',
        'payment' => 'Payment Section',
        'course_exam' => 'Course Exam',
        'settings' => 'Settings',
        'model_exam_category' => 'Model Exam Category',
        'model_exam_topics' => 'Model Exam Topic',
        'model_exam_tags' => 'Model Exam Tag',
        'model_exam' => 'Model Exam',
        'model_exam_result' => 'Model Exam Result',
        'model_exam_tag_analysis' => 'Model Exam Tag Analysis',
        'model_exam_payment' => 'Model Exam Payment',
        'contact_us' => 'Contact Us'
    ];
}
