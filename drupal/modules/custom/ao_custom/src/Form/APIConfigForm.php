<?php

namespace Drupal\ao_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class APIConfigForm extends FormBase
{
  public function getFormId()
  {
    return 'ao_api_config_page';
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $values = \Drupal::state()->get('ao_api_config_page.values');
    $form = [];
    $form['api_base_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Base URL'),
      '#description' => '',
      '#default_value' => $values['api_base_url']
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Save'),
        '#button_type' => 'primary'
      ]
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $submitted_values = $form_state->cleanValues()->getValues();
    \Drupal::state()->set('ao_api_config_page.values', $submitted_values);
    $messenger = \Drupal::service('messenger');
    $messenger->addMessage($this->t('Your api configuration has been saved.'));
  }
}
