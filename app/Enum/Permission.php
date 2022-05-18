<?php

namespace App\Enum;

interface Permission {

    const List = [
        'user' => 'User Section',
        'role_permission' => 'Role & Permission',
        'other' => 'Other',
        'payment' => 'Payment Section',
        'settings' => 'Settings',
        'model_exam_category' => 'Model Exam Category',
        'model_exam_topics' => 'Model Exam Topic',
        'model_exam_tags' => 'Model Exam Tag',
        'model_exam' => 'Model Exam',
        'model_exam_result' => 'Model Exam Result',
        'model_exam_tag_analysis' => 'Model Exam Tag Analysis',
        'model_exam_payment' => 'Model Exam Payment',
        'contact_us' => 'Contact Us',
        'free_category_access' => 'Free Category Access',
        'coupon' => 'Coupon',
        'course_category' => 'Course: Category',
        'course_program' => 'Course: Program',
        'course_bundle' => 'Course: Bundle',
        'course' => 'Course',
        'course_batch' => 'Course: Batch',
        'course_island' => 'Course: Island',
        'course_add_batch_to_island' => 'Course: Add batch to island',
        'course_content_tag' => 'Course: Content tag',
        'course_exam' => 'Course: Exam',
        'course_batch_exam' => 'Course: Batch exam',
        'course_lecture' => 'Course: Lecture',
    ];
}
