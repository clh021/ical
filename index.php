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

$conf = require_once __DIR__ . '/config.php';

$events = [];

foreach ($conf as $c) {
    $t = 0;
    do {
        // 计算有效时间
        $c['date_begin'] = nextDate($c['date_begin'], $c['cycle_set']);
        $c['date_end'] = nextDate($c['date_end'], $c['cycle_set']);

        $t = strtotime($c['date_begin']);
        // TODO: 计算一段时间内的所有事件提醒，输出至订阅
        // TODO: 输出时间段内的截止时间，提醒更新日历事件更新
        // var_dump($c);
        $events[] = getEvent($c);
    } while ($t < strtotime($calendar_end));
}

// 2. Create Calendar domain entity.
$calendar = new Calendar($events);

// 3. Transform domain entity into an iCalendar component
$componentFactory = new CalendarFactory();
$calendarComponent = $componentFactory->createCalendar($calendar);


// 4. Output
if(is_cli()) {
    shell_exec("rm -rf ./dist;mkdir dist;");
    $calendarStr = (string) $calendarComponent;
    file_put_contents('dist/' . date("Ymd.Hi", strtotime("+8 hours")) . '.calendar.ics', $calendarStr);
    file_put_contents('dist/calendar.ics', $calendarStr);
} else {
    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename="cal.ics"');
    echo $calendarComponent;
}
