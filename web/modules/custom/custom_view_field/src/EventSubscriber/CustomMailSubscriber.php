<?php

/**
 * @file
 * Contains \Drupal\custom_view_field\ExampleEventSubScriber.
 */

namespace Drupal\custom_view_field\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\custom_view_field\Event\SubmitMailEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class ExampleEventSubScriber.
 *
 * @package Drupal\custom_view_field
 */
class CustomMailSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ConfigEvents::SAVE][] = array('onSavingConfig', 800);
    $events[SubmitMailEvent::SUBMIT][] = 'doSomeAction';
    return $events;

  }

  /**
   * Subscriber Callback for the event.
   * @param ExampleEvent $event
   */
  public function doSomeAction(SubmitMailEvent $event) {
    // dump('demo');
    // dump($event);
    // dump($event->getCustomFormState());
    $form_state = $event->getCustomFormState();
    $text = $form_state->getValue('test');
    
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'custom_view_field';
    $key = 'send_mail_custom'; // Replace with Your key
    $to = \Drupal::currentUser()->getEmail();
    // $params['message'] = "This is message from custom EventSubsciber mail sending functionality";
    $params['message'] = $text;
    $params['title'] = "Title for mail send";
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;

    $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
    if ($result['result'] != true) {
        $message = t('There was a problem sending your email notification to @email.', array('@email' => $to));
        \Drupal::messenger()->addError($message);
        \Drupal::logger('mail-log')->error($message);
        return;
    }

    $message = t('An email notification has been sent to @email ', array('@email' => $to));
    
    \Drupal::logger('mail-log')->notice($message);
    \Drupal::messenger()->addMessage($message);
  }

  /**
   * Subscriber Callback for the event.
   * @param ConfigCrudEvent $event
   */
  public function onSavingConfig(ConfigCrudEvent $event) {
    // drupal_set_message("You have saved a configuration of " . $event->getConfig()->getName());
  }
}