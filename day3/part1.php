<?php
$content = file_get_contents('input.txt');

$sum = 0;
$pattern = '/mul\(\d+\,\d+\)/';

$matches = null;
preg_match_all($pattern, $content, $matches);
$matches = $matches[0];
$leftPatternToRemove = 'mul\(';
$rightPatternToRemove = '\)';
foreach ($matches as $match) {
    $numbersString = ltrim($match, $leftPatternToRemove);
    $numbersString = rtrim($numbersString, $rightPatternToRemove);
    $number = explode(',', $numbersString);
    $sum = $sum + ((int) $number[0] * (int) $number[1]);
}

echo $sum;