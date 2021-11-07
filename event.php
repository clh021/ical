<?php
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

require_once __DIR__ . '/lunar.php';

$lunar = new Lunar();

function getEvent($c) {
    global $lunar;
    if ($c['in_lunar']) {
        $date_begin_time = strtotime($c['date_begin']);
        $date_end_time = strtotime($c['date_end']);
        $c['translated_date_begin'] = date("Y-m-d", $lunar->L2S(date('Y-m-d', $date_begin_time))) . date(' H:i:s', $date_begin_time);
        $c['translated_date_end'] = date("Y-m-d", $lunar->L2S(date('Y-m-d', $date_end_time))) . date(' H:i:s', $date_end_time);
    } else {
        $c['translated_date_begin'] = $c['date_begin'];
        $c['translated_date_end'] = $c['date_end'];
    }

    $Occurrence = new TimeSpan(
        new DateTime(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $c['translated_date_begin']), true),
        new DateTime(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $c['translated_date_end']), true)
    );
    $Location = new Location('地点1.1', '地点1.2');
    $GPS = new GeographicPosition(47.557579, 10.749704);
    $Alarm = new Alarm(
        new Alarm\DisplayAction('Reminder: ' . $c['title'] . '!'),
        // new Alarm\DisplayAction('Reminder: the meeting starts in 15 minutes!'),
        // (new Alarm\RelativeTrigger(DateInterval::createFromDateString('-15 minutes')))->withRelationToEnd()
        (new Alarm\RelativeTrigger(DateInterval::createFromDateString($c['alarm_trigger'])))->withRelationToEnd()
    );
    $Attach = new Attachment(
        new Uri('https://ical.poerschke.nrw/favicon.ico'),
        'image/x-icon'
    );
    $event = new Event();
    $event
        ->setSummary($c['title'])
        ->setDescription('setDescription:' . $c['title'])
        ->setOrganizer(getOrganizer())
        // ->setLocation(($Location)->withGeographicPosition($GPS))
        ->setOccurrence($Occurrence)
        ->addAlarm($Alarm)
        // ->addAttachment($Attach)
    ;
    return $event;
}

function getOrganizer()
{
    return new Organizer(new EmailAddress('clh021@gmail.com'), 'chenlianghong');
}
function getLocation()
{
    return new Organizer(new EmailAddress('clh021@gmail.com'), 'chenlianghong');
}

function getEventDefault() {
    $event = new Event();
    $event
        ->setSummary('Christmas Eve')
        ->setDescription('Lorem Ipsum Dolor...')
        ->setOrganizer(new Organizer(
            new EmailAddress('clh021@gmail.com'),
            'chenlianghong'
        ))
        ->setLocation(
            (new Location('Neuschwansteinstraße 20, 87645 Schwangau', 'Schloss Neuschwanstein'))
                ->withGeographicPosition(new GeographicPosition(47.557579, 10.749704))
        )
        ->setOccurrence(
            new TimeSpan(
                new DateTime(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2021-12-24 13:30:00'), true),
                new DateTime(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2021-12-24 14:30:00'), true)
            )
        )
        ->addAlarm(
            new Alarm(
                new Alarm\DisplayAction('Reminder: the meeting starts in 15 minutes!'),
                (new Alarm\RelativeTrigger(DateInterval::createFromDateString('-15 minutes')))->withRelationToEnd()
            )
        )
        ->addAttachment(
            new Attachment(
                new Uri('https://ical.poerschke.nrw/favicon.ico'),
                'image/x-icon'
            )
        )
    ;
    return $event;
}
