<?php

namespace Drupal\custom_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Provides a block with a simple text.
*
* @Block(
*   id = "custom_block_basic",
*   admin_label = @Translation("Custom demo block"),
*   category = "Examples Block"
* )
*/

class CustomBlock extends BlockBase{
  public function build(){
    // Return markup
    // return [
    //   '#markup' => 'This is a simple block that displays some text!',
    // ];

    // Return form in block
    // Build the form using the FormBuilder service.
    $form = \Drupal::formBuilder()->getForm('\Drupal\custom_view_field\Form\CustomUserForm');

    return $form;
  }
}