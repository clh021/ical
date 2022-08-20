// import solarLunar from 'solarLunar';

const yaml = require('js-yaml');
const fs = require('fs');

try {
    const doc = yaml.load(fs.readFileSync('./config.yaml', 'utf8'));
    console.log(doc);
} catch (e) {
    console.log(e);
}

// const solar2lunarData = solarLunar.solar2lunar(2015, 10, 8); // 输入的日子为公历
// const lunar2solarData = solarLunar.lunar2solar(2015, 8, 26); // 输入的日子为农历