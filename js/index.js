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
    let tmpNext = c.date_next_begin;
    let event_list = [];
    do {
        event_list.push(tmpNext);
        // tmpNext
    } while (c.date_begin.getFullYear < (year + 1));


    console.log(`${year}-${c.date_begin}`)
    console.log(`${year}-${c.date_end}`)
}

const configToTrigger = (c) => {
    confParse(c)
    console.log(c)
    // 生成列表事件
    // 排序
    // 写入为 json 文件
    // const solar2lunarData = solarLunar.solar2lunar(2015, 10, 8); // 输入的日子为公历
    // const lunar2solarData = solarLunar.lunar2solar(2015, 8, 26); // 输入的日子为农历
}

const config = yaml.load(fs.readFileSync('./config.yaml', 'utf8'));
config.calendar_list.forEach(configToTrigger);