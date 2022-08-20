// import solarLunar from 'solarLunar';

const yaml = require('js-yaml');
const fs = require('fs');

const config = yaml.load(fs.readFileSync('./config.yaml', 'utf8'));
// console.log(JSON.stringify(config));

config.calendar_list.forEach(cal => {
    console.log(cal)
});
// const solar2lunarData = solarLunar.solar2lunar(2015, 10, 8); // 输入的日子为公历
// const lunar2solarData = solarLunar.lunar2solar(2015, 8, 26); // 输入的日子为农历