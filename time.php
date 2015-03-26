<?php

$now = time();

date_default_timezone_set('Europe/Moscow');

/*
echo 'Сейчас - ' . date('d-m-Y H:i:s', $now);

$future_1 = (mktime(0, 0, 0, 07, 14, 2015) - $now)/60/60/24;

echo 'До 14 июня остается - '. $future_1;


$rawDate = "16.02 2015";

$start = \DateTime::createFromFormat('d. m. Y', $raw);
echo 'Start date: ' . $start->format('m/d/Y') . "\n";
$now = new \DateTime();
echo 'Time to change your life is: ' . $now->format('H:i:s d.m.Y') . "\n";
// создаем копию $start и прибавляем 1 месяц и 6 дней
$end = clone $start;
$end->add(new \DateInterval('P1M6D'));
$diff = $end->diff($start);
echo 'Difference: ' . $diff->format('%m month, %d days (total: %a days)') . "\n";
// Difference: 1 month, 6 days (total: 37 days)
*/
// Дата 15 дн назад
$now = new \DateTime();
$today = $now->format('d/m/Y H:i:s');
echo 'Сегодня ' . $today;
$before = clone $now;
$previous = $before->sub(new \DateInterval('P15D'));
$previousDay = $previous->format('d.m.Y');
echo '<br />15 дней назад было ' . $previousDay;




