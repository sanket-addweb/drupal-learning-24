<?php

namespace Drupal\custom_view_field\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\views\Event\ViewExecutableEvent;
use Drupal\views\ViewExecutable;
use Drupal\views\Views;

/**
 * Class CustomViewQueryAlterSubscriber.
 */
class CustomViewQueryAlterSubscriber implements EventSubscriberInterface {

  /**
   * Constructor.
   */
  public function __construct() {
    // Constructor logic if needed.
  }

//   /**
//    * {@inheritdoc}
//    */
//   public static function getSubscribedEvents() {
//     $events[ViewExecutable::EVENT_QUERY_ALTER][] = ['alterViewQuery'];
//     return $events;
//   }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // $events['views.query.alter'] = ['alterViewQuery'];
    $events[Views::Query_alter][] = ['alterViewQuery'];
    return $events;
  }

  /**
   * Alter the view query.
   *
   * @param \Drupal\views\Event\ViewExecutableEvent $event
   *   The view event.
   */
  public function alterViewQuery(ViewExecutableEvent $event) {
    /** @var \Drupal\views\ViewExecutable $view */
    $view = $event->getView();
    dump($view);
    exit;
    
    // Check if this is the view you want to alter.
    if ($view->id() == 'my_articles') {
      // Perform your query alterations here.
      $query = $view->getQuery();
      // Example: Add a condition to the query.
    //   $query->condition('field_name', 'value');
    }
  }

}
