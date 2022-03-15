<?php

namespace App\Enum;

interface EducationLevel {
    const CLASS_6 = 6;
    const CLASS_7 = 7;
    const CLASS_8 = 8;
    const CLASS_9 = 9;
    const CLASS_10 = 10;
    const CLASS_11 = 11;
    const CLASS_12 = 12;
    const ADMISSION = 13;
    const JOB = 18;

    const Level = [
        '6' => 'Level 6',
        '7' => 'Level 7',
        '8' => 'Level 8',
        '9' => 'Level 9',
        '10' => 'Level 10',
        '11' => 'Level 11',
        '12' => 'Level 12',
        '13' => 'ADMISSION',
        '18' => 'JOB',
    ];
}
