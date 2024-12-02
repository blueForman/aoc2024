<?php
$content =  \file_get_contents("input_part1.txt");
$list1 = [];
$list2 = [];
$rows = explode("\n", $content);

$distances = 0;

foreach ($rows as $row) {
    $entries = explode(" ", $row);
    $numbers = array_filter($entries, fn(string $entry) => is_numeric($entry));
    $list1[] = (int)array_shift($numbers);
    $list2[] = (int)array_shift($numbers);
}
sort($list1);
sort($list2);

for ($i = 0; $i < count($list1); $i++) {
    $distance = abs($list1[$i] - $list2[$i]);
    $distances += $distance;
}

echo $distances;