var LunarCalendar = require("lunar-calendar");
const yaml = require('js-yaml');
const fs = require('fs');

const isDate = (d) => {
    return (new Date(d) !== "Invalid Date") && !isNaN(new Date(d));
}

const getRealDate = (is_lunar, date_get) => {
    if (is_lunar) {
        let lunar = LunarCalendar.lunarToSolar(
            date_get.getFullYear(),
            date_get.getMonth() + 1,
            date_get.getDate()
        )
        let tmp = `${lunar.year}-${lunar.month}-${lunar.day} `
        tmp += `${date_get.getHours()}:${date_get.getMinutes()}:${date_get.getSeconds()}`
        return new Date(tmp)
    }
    return date_get
}

const confParse = (c) => {
    let year = (new Date()).getFullYear();

    // 今明年范围内的时间都在列表范围
    let tmpBegin = `${year}-${c.date_begin}`
    // let tmpEnd = `${year}-${c.date_end}`
    if (isDate(tmpBegin)) {
        c.date_next_begin = new Date(tmpBegin)
        // 根据配置决定是否转换农历
        c.date_next_begin_real = getRealDate(c.is_lunar, c.date_next_begin)
    }
    // if (isDate(tmpEnd)) {
    //     c.date_next_end = new Date(tmpEnd)
    //     // 根据配置决定是否转换农历
    //     c.date_next_end_real = getRealDate(c.is_lunar, c.date_next_end)
    // }

    // 两年内的事件列表
    let tmpNext = new Date(tmpBegin);
    let event_list = [];
    do {
        let real = getRealDate(c.is_lunar, tmpNext)
        event_list.push(new Date(real.toISOString()));
        if (c.cycle.hasOwnProperty("year")) {
            tmpNext.setFullYear(tmpNext.getFullYear() + c.cycle.year)
        }
        if (c.cycle.hasOwnProperty("month")) {
            tmpNext.setMonth(tmpNext.getMonth() + c.cycle.month)
        }
        if (c.cycle.hasOwnProperty("day")) {
            let hourCount = c.cycle.day * 24
            tmpNext.setHours(tmpNext.getHours() + hourCount)
        }
    } while (tmpNext.getFullYear() < (year + 2));
    c.event_list = event_list;

    // 两年内的提醒列表
    c.alarm.forEach(a => {
        let alarm_list = [];
        event_list.forEach(e => {
            let alarm_time = new Date(e)
            if (a.hasOwnProperty("day")) {
                let hourCount = a.day * 24
                alarm_time.setHours(alarm_time.getHours() + hourCount)
            }
            alarm_list.push(alarm_time)
        })
        a.list = alarm_list
    })
}


// 读取配置 
const config = yaml.load(fs.readFileSync('./config.yaml', 'utf8'));
// 解析配置
config.calendar_list.forEach(confParse);
// 生成列表事件
// 排序
// 写入结果
fs.writeFileSync('./../dist/result.json', JSON.stringify(config))