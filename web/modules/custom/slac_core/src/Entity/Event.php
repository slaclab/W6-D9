<?php

namespace Drupal\slac_core\Entity;

use DateTime;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;

/**
 * Defines the base field override entity.
 *
 * Allows base fields to be overridden on the bundle level.
 *
 * @ConfigEntityType(
 *   id = "event",
 *   label = @Translation("Event bundle class"),
 * )
 */

interface EventInterface extends NodeInterface {
  public function getEventTense() : string;
  public function isPastEvent(): bool;
}

class Event extends Node implements EventInterface {
  use StringTranslationTrait;

  /**
   * Get the tense of the event, past, in-progress, or upcoming.
   *
   * @return string
   *
   * @throws \Exception
   */
  public function getEventTense(): string {
    // 0 = in progress (default)
    // -1 = event is before the current day or time within the same day
    // 1 = event is after the current day or time within the same day
    $time_order = 0;
    $event_tenses = [
      0 => 'In Progress',
      -1 => 'Past',
      1 => 'Upcoming',
    ];

    // Get the current default timezone.
    $default_timezone = new \DateTimeZone(date_default_timezone_get());
    $utc_timezone = new \DateTimeZone('UTC');

    // Get the current date and time as a DateTime object and set the current timezone.
    $now = date_create();
    $now->setTimezone($default_timezone);

    // Retrieve the start and end dates of this event and make sure the
    // correct timezone is set. Values retrieved from the field are not guaranteed
    // to be translated into the correct timezone, so assume they are in UTC zone and
    // convert to the system default (likely to be Los Angeles).
    $event_date_start = new DateTime($this->get('field_datetime_range')->value, $utc_timezone);
    $event_date_start->setTimezone($default_timezone);
    $event_date_end = new DateTime($this->get('field_datetime_range')->end_value, $utc_timezone);
    $event_date_end->setTimezone($default_timezone);

    // Use date comparison to determine order.
    if ($event_date_end->format('U') < $now->format('U')) {
      $time_order = -1;
    }
    elseif ($event_date_start->format('U') > $now->format('U')) {
      $time_order = 1;
    }

    // Translate the return string.
    return $this->t($event_tenses[$time_order]);
  }

  /**
   * Is the event in the past.
   *
   * A past event is one whose end date occurs on the day before the current day. A multi-day event
   * whose end date is the current day or a future day is not in the past.
   *
   * @return bool
   *
   * @throws \Exception
   */
  public function isPastEvent(): bool {
    // Get the current date and time as a DateTime object.
    $now = date_create();

    // Get the current default timezone and the UTC timezone.
    $default_timezone = new \DateTimeZone(date_default_timezone_get());
    $utc_timezone = new \DateTimeZone('UTC');

    // Retrieve the end date of this event. An event is only in the past if the end date occurs
    // before the current day. Field values are retrieved in UTC time, convert to default tz.
    $event_date_end = new DateTime($this->get('field_datetime_range')->end_value, $utc_timezone);
    $event_date_end->setTimezone($default_timezone);

    return $event_date_end < $now;
  }

}


