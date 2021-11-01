<?php
// https: //ical.poerschke.nrw/docs/
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
$conf = require_once __DIR__ . './config.php';

$events = [];
foreach ($conf as $c) {
    $event = new Event();
    // $c['date']
    $event
        ->setSummary($c['title'])
        ->setOccurrence(
            new TimeSpan(
                new DateTime(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $c['date_begin']), true),
                new DateTime(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $c['date_end']), true)
            )
        )
        ->addAlarm(
            new Alarm(
                new Alarm\DisplayAction('Reminder: '.$c['title'].'!'),
                (new Alarm\RelativeTrigger(DateInterval::createFromDateString('-15 minutes')))->withRelationToEnd()
            )
        )
    ;
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