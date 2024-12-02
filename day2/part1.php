<?php
$content = file_get_contents('input.txt');
$levels = explode("\n", $content);
$safeReportCount = 0;

foreach ($levels as $level) {
    if (empty($level)) {
        continue;
    }
    $rawLevelElements = explode(" ", $level);
    $levelElements = array_filter($rawLevelElements, fn(string $element) => is_numeric($element));
    $levelElements = array_map(fn(string $element) => (int)$element, $levelElements);
    switch (true) {
        case isLevelDescending($levelElements) && areDistanceRulesMet($levelElements):
            $safeReportCount++;
            break;
        case isLevelAscending($levelElements) && areDistanceRulesMet($levelElements):
            $safeReportCount++;
            break;
    }
}

echo $safeReportCount;


function areDistanceRulesMet(array $levelElements): bool
{
    $previousElement = null;
    foreach ($levelElements as $element) {
        if (is_null($previousElement)) {
            $previousElement = $element;
            continue;
        }

        $distance = abs($previousElement - $element);
        if ($distance < 1 || $distance > 3) {
            $previousElement = $element;
            return false;
        }

        $previousElement = $element;
    }
    return true;
}


function isLevelDescending(array $levelElements): bool
{
    $previousElement = null;
    foreach ($levelElements as $element) {
        if (is_null($previousElement)) {
            $previousElement = $element;
            continue;
        }

        if ($previousElement < $element) {
            $previousElement = $element;
            return false;
        }
        $previousElement = $element;
    }

    return true;
}

function isLevelAscending(array $levelElements): bool
{
    $previousElement = null;
    foreach ($levelElements as $element) {
        if (is_null($previousElement)) {
            $previousElement = $element;
            continue;
        }

        if ($previousElement > $element) {
            $previousElement = $element;
            return false;
        }
        $previousElement = $element;
    }

    return true;
}