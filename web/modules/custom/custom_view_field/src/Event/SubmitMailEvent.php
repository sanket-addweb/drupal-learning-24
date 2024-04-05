<?php

namespace Drupal\custom_view_field\Event;

// use Symfony\Component\EventDispatcher\Event;
use Drupal\Component\EventDispatcher\Event;

class SubmitMailEvent extends Event {

  const SUBMIT = 'event.submit';
  protected $referenceID;

  public function __construct($referenceID)
  {
    $this->referenceID = $referenceID;
  }

  public function getReferenceID()
  {
    return $this->referenceID;
  }

  public function myEventDescription() {
    return "This is as an example event";
  }
}