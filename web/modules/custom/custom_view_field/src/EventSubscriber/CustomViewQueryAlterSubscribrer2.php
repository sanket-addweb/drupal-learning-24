<?php

namespace Drupal\custom_view_field\EventSubscriber;

use Drupal\views\ViewExecutable;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\custom_view_field\Event\ViewQueryAlterEvent;

/**
 * Modifies the views query.
 */
class CustomViewQueryAlterSubscribrer2 implements EventSubscriberInterface {

  /**
   * Modifies the view query.
   *
   * @param \Drupal\custom_view_field\Event\ViewQueryAlterEvent $event
   *   The event to process.
   */
  public function modifyViewQuery(ViewQueryAlterEvent $event) {
    /** @var \Drupal\views\ViewExecutable $view */
    $view = $event->view;
    if($view->id() == 'my_articles'){
      // dump($query = $view->getQuery());
      $query = $view->getQuery();
      $query->addWhere('node', 'status', 1);
      // $query->condition('node.id', 2, '=');//not working
      // $query->addField('node__field_tags_new','field_tags_new_target_id', 'alias_for_field_tags_new');
      // $query->leftjoin('taxonomy_term_field_data', 'td', 'td.tid = node__field_tags_new.field_tags_new_target_id');//not working
      // $query->addField('taxonomy_term_field_data','name', 'alias_for_term_name');

      // Add the field 'field_tags_new_target_id' with an alias.
      $query->addField('node__field_tags_new', 'field_tags_new_target_id', 'alias_for_field_tags_new');//not display

      // dump($query = $view->getQuery());
      \Drupal::messenger()->addStatus('This is demo query alter');
      return $query;
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      ViewQueryAlterEvent::EVENT_NAME => 'modifyViewQuery',
    ];

    // $events = [];
    // // Subscribe to the views pre_execute event.
    // $events['views.pre_execute'] = ['modifyViewQuery'];
    // return $events;

  }

}