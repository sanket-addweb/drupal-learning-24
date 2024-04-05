<?php
namespace Drupal\custom_view_field\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\user\UserInterface;

use Drupal\views\ViewExecutable;
use Drupal\views\Views;

/**
 * Event that is fired when a user logs in.
 */
class ViewQueryAlterEvent extends Event {

  public $view;

  // This makes it easier for subscribers to reliably use our event name.
  const EVENT_NAME = 'custom_view_query_alter';

  // This drow error
  // public function __construct(ViewExecutable $view){
  //   dump('sanket');
  //   // $this->view = $view;
  // }
  public function __construct($view) {
    // dump($view);
    // dump('sanket');
    // exit;
    // if (!($view instanceof ViewExecutable)) {
    //     throw new \InvalidArgumentException('$view must be an instance of ViewExecutable.');
    // }
    $this->view = $view;
  }
}