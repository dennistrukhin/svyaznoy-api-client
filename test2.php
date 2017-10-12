<?php

$money = 0;

$gamesNumber = 100000;
$lossStreak = 0;
$baseStake = 1;
$maxDrawDown = 0;
$maxAllowedDrawDown = -1000;

for ($i = 1; $i <= $gamesNumber; $i++) {
    $stake = $baseStake * 2 ** $lossStreak;
    $money -= $stake;
    $result = mt_rand(1, 100);
    if ($result <= 48) {
        $money += 2 * $stake;
        $lossStreak = 0;
    } else {
        $lossStreak++;
    }
    if ($money < $maxDrawDown) {
        $maxDrawDown = $money;
    }
    if ($maxDrawDown < $maxDrawDown) {
        break;
    }
//    echo $i . ' stake = ' . $stake . ', result = ' . ($result <= 48 ? 'win' : 'loss') . ', money = ' . $money . PHP_EOL;
}

echo $money . PHP_EOL;
echo $maxDrawDown;