<?php
// https: //ical.poerschke.nrw/docs/ # 具体规则文档
// https://ical.marudot.com/ # 文件生成器 可用来加载生成好的文件
// https://www.eventolist.com/ # 付费的事件清单在线服务
// https://ical.marudot.com/pages/result.jsp 
// https://icalendar.org # 推广ical标准，含验证器，规则工具库，资源

namespace Example;

use DateInterval;
use DateTimeImmutable;
use Eluceo\iCal\Domain\Entity\Calendar;
use Eluceo\iCal\Domain\Entity\Event;
use Eluceo\iCal\Domain\ValueObject\Alarm;
use Eluceo\iCal\Domain\ValueObject\Attachment;
use Eluceo\iCal\Domain\ValueObject\DateTime;
use Eluceo\iCal\Domain\ValueObject\EmailAddress;
use Eluceo\iCal\Domain\ValueObject\GeographicPosition;
use Eluceo\iCal\Domain\ValueObject\Location;
use Eluceo\iCal\Domain\ValueObject\Organizer;
use Eluceo\iCal\Domain\ValueObject\TimeSpan;
use Eluceo\iCal\Domain\ValueObject\Uri;
use Eluceo\iCal\Presentation\Factory\CalendarFactory;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/event.php';
require_once __DIR__ . '/lunar.php';

$conf = require_once __DIR__ . '/config.php';

$events = [];
$lunar = new Lunar();

foreach ($conf as $c) {
    // TODO: 计算一段时间内的所有事件提醒，输出至订阅
    // TODO: 输出时间段内的截止时间，提醒更新日历事件更新

    if ($c['in_lunar']) {
        $date_begin_time = strtotime($c['date_begin']);
        $date_end_time = strtotime($c['date_end']);
        $c['translated_date_begin'] = date("Y-m-d", $lunar->L2S(date('Y-m-d', $date_begin_time))) . date(' H:i:s', $date_begin_time);
        $c['translated_date_end'] = date("Y-m-d", $lunar->L2S(date('Y-m-d', $date_end_time))) . date(' H:i:s', $date_end_time);
    } else {
        $c['translated_date_begin'] = $c['date_begin'];
        $c['translated_date_end'] = $c['date_end'];
    }
    // var_dump($c);

    $events[] = getEvent($c);
}

// 2. Create Calendar domain entity.
$calendar = new Calendar($events);

// 3. Transform domain entity into an iCalendar component
$componentFactory = new CalendarFactory();
$calendarComponent = $componentFactory->createCalendar($calendar);


// 4. Output
if(is_cli()) {
    file_put_contents('calendar.ics', (string) $calendarComponent);
} else {
    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename="cal.ics"');
    echo $calendarComponent;
}
