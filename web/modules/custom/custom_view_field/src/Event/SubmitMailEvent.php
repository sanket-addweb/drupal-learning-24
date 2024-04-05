<?php

namespace Drupal\custom_view_field\Event;

// use Symfony\Component\EventDispatcher\Event;
use Drupal\Component\EventDispatcher\Event;

class SubmitMailEvent extends Event {

  const SUBMIT = 'event.submit';
  protected $getform_state;

  public function __construct($form_state){
    $this->getform_state = $form_state;
  }

  public function getCustomFormState(){
    return $this->getform_state;
  }

  public function myEventDescription() {
    return "This is as an example event";
  }
}