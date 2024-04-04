<?php

namespace Drupal\custom_view_field\Plugin\views\sort;

use Drupal\views\Plugin\views\sort\SortPluginBase;

/**
 * Provides custom sorting for the 'custom_field' field.
 *
 * @ViewsSort("event")
 */
class CustomDateSortHandler extends SortPluginBase {

  /**
   * The current display.
   *
   * @var string
   *   The current display of the view.
   */
  protected $currentDisplay;

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Do nothing -- to override the parent query.
    // $this->query->addOrderBy('node__field_event_date', 'field_event_date_value', 'DESC'); //static DESC order
    $this->query->addOrderBy('node__field_event_date', 'field_event_date_value', $this->options['order']);
  }

  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['order'] = ['default' => 'ASC'];
    $options['exposed'] = ['default' => FALSE];
    $options['expose'] = [
      'contains' => [
        'label' => ['default' => ''],
        'field_identifier' => ['default' => ''],
      ],
    ];
    return $options;
  }

}
