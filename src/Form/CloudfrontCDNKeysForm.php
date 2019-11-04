<?php

namespace Drupal\cloudfront_path_invalidate\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class CloudfrontCDNKeysForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cloudfront_path_invalidate_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'cloudfront_path_invalidate.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('cloudfront_path_invalidate.settings');
    $form['cloudfront_path_invalidate_distribution'] = [
      '#type' => 'textfield',
      '#title' => t('Distribution ID'),
      '#required' => TRUE,
      '#default_value' => $config->get('cloudfront_path_invalidate_distribution'),
    ];
    $form['cloudfront_path_invalidate_access'] = [
      '#type' => 'password',
      '#title' => t('Access Key'),
      '#required' => TRUE,
      '#attributes' => array('value' => $config->get('cloudfront_path_invalidate_access')),
    ];
    $form['cloudfront_path_invalidate_secret'] = [
      '#type' => 'password',
      '#title' => t('Secret Key'),
      '#required' => TRUE,
      '#attributes' => array('value' => $config->get('cloudfront_path_invalidate_secret')),
    ];
    $form['cloudfront_path_invalidate_homapage'] = [
      '#type' => 'textfield',
      '#title' => t('Homepage node_id or url_alias. This will include "/" 
    with invalidation paths listed below. (eg. node/1234)'),
      '#default_value' => $config->get('cloudfront_path_invalidate_homapage'),
    ];
    $form['cloudfront_path_invalidate_host_provider'] = [
      '#type' => 'radios',
      '#title' => t('Please select you host provider (this will clear 
    varnish cache)'),
      '#options' => [
        t('Acquia'),
        t('Pantheon'),
        t('None of the above'),
      ],
      '#required' => TRUE,
      '#default_value' => $config->get('cloudfront_path_invalidate_host_provider'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('cloudfront_path_invalidate.settings')
      ->set('cloudfront_path_invalidate_distribution', $values['cloudfront_path_invalidate_distribution'])
      ->set('cloudfront_path_invalidate_access', $values['cloudfront_path_invalidate_access'])
      ->set('cloudfront_path_invalidate_secret', $values['cloudfront_path_invalidate_secret'])
      ->set('cloudfront_path_invalidate_homapage', $values['cloudfront_path_invalidate_homapage'])
      ->set('cloudfront_path_invalidate_host_provider', $values['cloudfront_path_invalidate_host_provider'])
      ->save();
    parent::submitForm($form, $form_state);
  }

}
