<?php

namespace Drupal\custom_view_field\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\custom_view_field\Event\SubmitMailEvent;

class CustomUserForm extends FormBase{
  public function getFormId(){
    return 'custom_user_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => t('Subject'),
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => t('Message'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit Now'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    // \Drupal::messanger()->addMessage('Test message');
    $dispatcher = \Drupal::service('event_dispatcher');
    $event = new SubmitMailEvent($form_state);
    $dispatcher->dispatch($event, SubmitMailEvent::SUBMIT);

    // dump($form_state->getValue('test'));
    // exit;
  }

}