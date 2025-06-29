<?php

function containsForbiddenWord($string)
{
    $badWords = [
        'hitler',
        'nazi',
        'fuck',
        'shit',
        'bitch',
        'asshole',
        'bastard',
    ];

    $lower = mb_strtolower($string, 'UTF-8');
    foreach ($badWords as $word) {
        if (strpos($lower, $word) !== false) {
            return true;
        }
    }
    return false;
}
