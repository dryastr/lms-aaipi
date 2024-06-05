<?php

namespace App\Bitwise;

class UserLevelOfTraining extends Bitwise
{
    const BEGINNER = 1;

    const MIDDLE = 2;

    const EXPERT = 4;

    public static $levelOfTraining = [
        'beginner',
        'middle',
        'expert',
    ];

    public static $levelOfTrainingValueByBit = [
        1 => 'beginner',
        2 => 'middle',
        4 => 'expert',
    ];

    public static $levelOfTrainingBitByValue = [
        'beginner' => 1,
        'middle' => 2,
        'expert' => 4,
    ];
}
