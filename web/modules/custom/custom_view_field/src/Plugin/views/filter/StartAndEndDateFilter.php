<?php

namespace Drupal\MY_MODULE\Plugin\views\filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\filter\StringFilter;

/**
 * Filter by start and end date.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("start_and_end_date")
 */
class StartAndEndDateFilter extends StringFilter {

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['start_date'] = ['default' => NULL];
    $options['end_date'] = ['default' => NULL];

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    $form['start_date'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Start date'),
      '#description' => $this->t('Timestamp or string containing a relative date.'),
      '#default_value' => $this->options['start_date'],
      '#required' => TRUE,
    ];

    $form['end_date'] = [
      '#type' => 'textfield',
      '#title' => $this->t('End date'),
      '#description' => $this->t('Timestamp or string containing a relative date.'),
      '#default_value' => $this->options['end_date'],
      '#required' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateOptionsForm(&$form, FormStateInterface $form_state) {
    parent::validateOptionsForm($form, $form_state);

    if (strtotime($form_state->getValues()['options']['start_date']) === FALSE) {
      $form_state->setError($form['start_date'], $this->t('Provided value is not a valid timestamp or string containing a relative date.'));
    }

    if (strtotime($form_state->getValues()['options']['end_date']) === FALSE) {
      $form_state->setError($form['end_date'], $this->t('Provided value is not a valid timestamp or string containing a relative date.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    $this->ensureMyTable();

    /** @var \Drupal\views\Plugin\views\query\Sql $query */
    $query = $this->query;
    $table = array_key_first($query->tables);

    $first_day_last_month = strtotime($this->options['start_date']);
    $query->addWhere($this->options['group'], $table . '.created', $first_day_last_month, '>=');

    $first_day_this_month = strtotime($this->options['end_date']);
    $query->addWhere($this->options['group'], $table . '.created', $first_day_this_month, '<=');
  }

}
