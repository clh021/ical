<?php
$date_begin_test = date("Y-m-d H:i:s", strtotime("+3 hours"));
$date_end_test = date("Y-m-d H:i:s", strtotime("+1 days"));
$calendar_begin = date("Y-m-d H:i:s");
$calendar_end = date("Y-m-d H:i:s", strtotime("+2 years"));

return [
    [
        'title'=>'test'.$calendar_begin,
        'date_begin' => $date_begin_test,
        'date_end' => $date_end_test,
        'in_lunar' => false,//是否使用农历计算
        'cycle_unit'=>'mounth',//循环单位
        'cycle_set'=>1,//循环天数
        'alarm_display'=>true,//显示闹钟
        'alarm_trigger'=>'-3 days',//提前触发闹钟 //'-15 minutes'
    ],
    [
        'title'=>'bread',
        'date_begin' => '2021-10-14 09:00:00',
        'date_end' => '2021-10-14 12:40:00',
        'in_lunar' => false,//是否使用农历计算
        'cycle_unit'=>'day',//循环单位
        'cycle_set'=>28,//循环天数
        'alarm_display'=>true,//显示闹钟
        'alarm_trigger'=>'-3 days',//提前触发闹钟 //'-15 minutes'
    ],
    [
        'title'=>'house loan',
        'date_begin' => '2021-10-20 09:00:00',
        'date_end' => '2021-10-20 12:40:00',
        'in_lunar' => false,
        'cycle_unit'=>'month',
        'cycle_set'=>1,
        'alarm_display'=>true,
        'alarm_trigger'=>'-2 days',
    ],
    [
        'title'=>'sister birthday',
        'date_begin' => '2021-07-06 09:00:00',
        'date_end' => '2021-07-06 12:40:00',
        'in_lunar' => true,
        'cycle_unit'=>'year',
        'cycle_set'=>1,
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'pmm birthday',
        'date_begin' => '2021-07-20 09:00:00',
        'date_end' => '2021-07-20 12:40:00',
        'in_lunar' => true,
        'cycle_unit'=>'year',
        'cycle_set'=>1,
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'mother birthday',
        'date_begin' => '2021-08-11 09:00:00',
        'date_end' => '2021-08-11 12:40:00',
        'in_lunar' => true,
        'cycle_unit'=>'year',
        'cycle_set'=>1,
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'father birthday',
        'date_begin' => '2021-09-20 09:00:00',
        'date_end' => '2021-09-20 12:40:00',
        'in_lunar' => true,
        'cycle_unit'=>'year',
        'cycle_set'=>1,
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'pl.father birthday',
        'date_begin' => '2021-06-19 09:00:00',
        'date_end' => '2021-06-19 12:40:00',
        'in_lunar' => true,
        'cycle_unit'=>'year',
        'cycle_set'=>1,
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
    [
        'title'=>'2018.32years.marriedDay',
        'date_begin' => '2021-10-18 09:00:00',
        'date_end' => '2021-10-18 12:40:00',
        'in_lunar' => true,
        'cycle_unit'=>'year',
        'cycle_set'=>1,
        'alarm_display'=>true,
        'alarm_trigger'=>'-7 days',
    ],
];