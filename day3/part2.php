<?php
$content = file_get_contents('input.txt');

function removeAllBetweenDontAndDo(string $content)
{
    $partsToGlue = [];
    $splittedByDo = explode('do()', $content);
    foreach ($splittedByDo as $part) {
        $parts = explode('don\'t()', $part);
        $partsToGlue[] = $parts[0];
    }

    return implode('', $partsToGlue);
}

$content = removeAllBetweenDontAndDo($content);

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