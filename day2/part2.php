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
    if (areLevelsSafe($levelElements)) {
        $safeReportCount++;
    } else {
        $retry = false;
        foreach ($levelElements as $key => $element) {
            $levelsCopy = $levelElements;
            unset($levelsCopy[$key]);
            if (areLevelsSafe($levelsCopy) && $retry == false) {
                $safeReportCount++;
                $retry = true;
            }
        }
    }
}

echo $safeReportCount;

function areLevelsSafe(array $levelElements): bool
{
    $previousElement = null;

    $isAscending = false;
    $isDescending = false;
    foreach ($levelElements as $element) {
        if (is_null($previousElement)) {
            $previousElement = $element;
            continue;
        }

        $diff = $element - $previousElement;

        if (abs($diff) < 1 || abs($diff) > 3) {
            return false;
        }

        if ($diff > 0) {
            $isAscending = true;
        } else if ($diff < 0) {
            $isDescending = true;
        }

        $previousElement = $element;
    }
    return ($isAscending || $isDescending) && ($isDescending != $isAscending);
}
