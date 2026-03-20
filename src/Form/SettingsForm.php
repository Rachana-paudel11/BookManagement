<?php

namespace Drupal\book_management\Form;

/**
 * @file src/Form/SettingsForm.php
 * PURPOSE: This file defines the global configuration settings form for the module.
 * It allows administrators to customize default book behavior and admin list display.
 */

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Book Management settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'book_management_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['book_management.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('book_management.settings');

    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#open' => TRUE,
    ];

    $form['general']['default_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Default Book Color'),
      '#description' => $this->t('The default background color for new book cards.'),
      '#default_value' => $config->get('default_color') ?: '#6c5ce7',
    ];

    $form['display'] = [
      '#type' => 'details',
      '#title' => $this->t('Admin Display Settings'),
      '#open' => TRUE,
    ];

    $form['display']['items_per_page'] = [
      '#type' => 'number',
      '#title' => $this->t('Items Per Page'),
      '#description' => $this->t('Number of books to display on the administrative list page.'),
      '#default_value' => $config->get('items_per_page') ?: 20,
      '#min' => 1,
      '#max' => 100,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('book_management.settings')
      ->set('default_color', $form_state->getValue('default_color'))
      ->set('items_per_page', $form_state->getValue('items_per_page'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
