<?php

namespace App\Enum;

interface ExamType {
    const MCQ = 1;
    const CQ = 2;
    const BQ = 3;

    const Exam = [
        '1' => 'MCS',
        '2' => 'CS',
        '3' => 'BQ'
    ];
}
