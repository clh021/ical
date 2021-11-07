<?php
$date_begin_test = date("Y-m-d H:i:s", strtotime("+3 hours"));
$date_end_test = date("Y-m-d H:i:s", strtotime("+6 hours"));
$calendar_begin = date("Y-m-d H:i:s");
$calendar_end = date("Y-m-d H:i:s", strtotime("+2 years"));
$ny = date("Y", strtotime("-1 year")); // last year

return [
    [
        'title'=>'test'.$calendar_begin,
        'date_begin' => $date_begin_test,
        'date_end' => $date_end_test,
        'in_lunar' => false,//是否使用农历计算
        'cycle_set'=>'+1 month',//循环设置
        'alarm_display'=>true,//显示闹钟
        'alarm_trigger'=>'-3 days',//提前触发闹钟 //'-15 minutes'
    ],
    [
        'title'=>'bread',
        'date_begin' => nextDate($ny.'-10-14 09:00:00','+28 days'),
        'date_end' => nextDate($ny.'-10-14 12:40:00','+28 days'),
        'in_lunar' => false,//是否使用农历计算
        'cycle_set'=>'+28 days',//循环设置
        'alarm_display'=>true,//显示闹钟
        'alarm_trigger'=>'-3 days',//提前触发闹钟 //'-15 minutes'
    ],
    [
        'title'=>'house loan',
        'date_begin' => nextDate($ny.'-10-20 09:00:00','+1 month'),
        'date_end' => nextDate($ny.'-10-20 12:40:00','+1 month'),
        'in_lunar' => false,
        'cycle_set'=>'+1 month',
        'alarm_display'=>true,
        'alarm_trigger'=>'-2 days',
    ],
    [
        'title'=>'sister birthday',
        'date_begin' => nextDate($ny.'-07-06 09:00:00','+1 year'),
        'date_end' => nextDate($ny.'-07-06 12:40:00','+1 year'),
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'pmm birthday',
        'date_begin' => nextDate($ny.'-07-20 09:00:00','+1 year'),
        'date_end' => nextDate($ny.'-07-20 12:40:00','+1 year'),
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'mother birthday',
        'date_begin' => nextDate($ny.'-08-11 09:00:00','+1 year'),
        'date_end' => nextDate($ny.'-08-11 12:40:00','+1 year'),
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'father birthday',
        'date_begin' => nextDate($ny.'-09-20 09:00:00','+1 year'),
        'date_end' => nextDate($ny.'-09-20 12:40:00','+1 year'),
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'pl.father birthday',
        'date_begin' => nextDate($ny.'-06-19 09:00:00','+1 year'),
        'date_end' => nextDate($ny.'-06-19 12:40:00','+1 year'),
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'2018.32years.marriedDay',
        'date_begin' => nextDate($ny.'-10-18 09:00:00','+1 year'),
        'date_end' => nextDate($ny.'-10-18 12:40:00','+1 year'),
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
];