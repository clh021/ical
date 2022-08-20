<?php
// 是否是命令行环境
function is_cli()
{
    return PHP_SAPI === 'cli';
}

// 是否是未来时间
function isValid($date_set) {
    return strtotime($date_set) > time();
}

// 设计用来计算公历日期，计算完后再进行农历转换
function nextDate($date_set, $cycle_set)
{
    $next_date_time = strtotime($cycle_set, strtotime($date_set));
    $next_date = date('Y-m-d H:i:s', $next_date_time);
    if (isValid($next_date)) {
        return $next_date;
    } else {
        return nextDate($next_date, $cycle_set);
    }
}
