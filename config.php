<?php
$date_begin_test = date("Y-m-d H:i:s", strtotime("+3 hours"));
$date_end_test = date("Y-m-d H:i:s", strtotime("+6 hours"));
$calendar_begin = date("Y-m-d H:i:s");
$calendar_end = date("Y-m-d H:i:s", strtotime("+1 years"));
//$ny = date("Y", strtotime("-1 year")); // last year
$ny = date("Y");

return [
    [
        'title'=>'test'.$calendar_begin,
        'date_begin' => $date_begin_test,
        'date_end' => $date_end_test,
        'in_lunar' => false,//是否使用农历计算
        'cycle_set'=>'+1 year',//循环设置
        'alarm_display'=>true,//显示闹钟
        'alarm_trigger'=>'-3 days',//提前触发闹钟 //'-15 minutes'
    ],
    [
        'title'=>'bread',
        'date_begin' => $ny.'-02-23 14:00:00','+26 days',
        'date_end' => $ny.'-02-23 18:00:00','+26 days',
        'in_lunar' => false,//是否使用农历计算
        'cycle_set'=>'+638 hours',//循环设置 638 hours =  +26 days + 14 hours
        'alarm_display'=>true,//显示闹钟
        'alarm_trigger'=>'-3 days',//提前触发闹钟 //'-15 minutes'
        // 10-14 ~ 11.10 -2 days 11.8
        // => 12.4(Not28Is26) , 12.6(Continue)
        // => 12.4(26IsOK,26.5) , 12.30(Continue), 01.26(?continue), 02.23(continue)
    ],
    [
        'title'=>'house loan',
        'date_begin' => $ny.'-10-20 09:00:00','+1 month',
        'date_end' => $ny.'-10-20 12:40:00','+1 month',
        'in_lunar' => false,
        'cycle_set'=>'+1 month',
        'alarm_display'=>true,
        'alarm_trigger'=>'-2 days',
    ],
    [
        'title'=>'sister birthday',
        'date_begin' => $ny.'-07-06 09:00:00','+1 year',
        'date_end' => $ny.'-07-06 12:40:00','+1 year',
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'pmm birthday',
        'date_begin' => $ny.'-07-20 09:00:00','+1 year',
        'date_end' => $ny.'-07-20 12:40:00','+1 year',
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'mother birthday',
        'date_begin' => $ny.'-08-11 09:00:00','+1 year',
        'date_end' => $ny.'-08-11 12:40:00','+1 year',
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'father birthday',
        'date_begin' => $ny.'-09-20 09:00:00','+1 year',
        'date_end' => $ny.'-09-20 12:40:00','+1 year',
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'pl.father birthday',
        'date_begin' => $ny.'-06-19 09:00:00','+1 year',
        'date_end' => $ny.'-06-19 12:40:00','+1 year',
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'2018.32years.marriedDay',
        'date_begin' => $ny.'-10-18 09:00:00','+1 year',
        'date_end' => $ny.'-10-18 12:40:00','+1 year',
        'in_lunar' => true,
        'cycle_set'=>'+1 year',
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
];
