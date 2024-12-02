<?php
$content =  \file_get_contents("input_part1.txt");
$list1 = [];
$list2 = [];
$rows = explode("\n", $content);

$similarityScore = 0;

foreach ($rows as $row) {
    $entries = explode(" ", $row);
    $numbers = array_filter($entries, fn(string $entry) => is_numeric($entry));
    $list1[] = (int)array_shift($numbers);
    $list2[] = (int)array_shift($numbers);
}

foreach ($list1 as $number) {
    $matches = array_filter($list2, fn(int $numberInRightList) => $numberInRightList === $number);
    $similarityScore += count($matches) * $number;
}

echo $similarityScore;