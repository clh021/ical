<?php
// https: //ical.poerschke.nrw/docs/

// 1. Create Event domain entity.
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