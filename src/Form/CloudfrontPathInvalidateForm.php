<?php

namespace Drupal\cloudfront_path_invalidate\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class CloudfrontPathInvalidateForm extends ConfigFormBase {

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
    $form['cloudfront_path_invalidate_invalidation_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Invalidation URL without the first leading "/" 
    eg. test/basic/path'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Clear on AWS Cloudfront'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $paths = array(
      htmlspecialchars($values["cloudfront_path_invalidate_invalidation_url"],
        ENT_QUOTES, 'UTF-8'),
    );
    //$response = cloudfront_path_invalidate_invalidate_on_cloudfront($paths);
    if (1==0) {
      drupal_set_message(t('@invalidated_path has successfully been 
    invalidated on CDN.', array('@invalidated_path' => $values["cloudfront_path_invalidate_invalidation_url"])));
    }
    else {
      drupal_set_message(t('Error @response: Unable to invalidate path. Please check 
    your AWS Credentials.', array('@response' => 'dedee')));
    }
    $this->config('cloudfront_path_invalidate.settings')
      ->set('variable_name', $values)
      ->save();
    //parent::submitForm($form, $form_state);
  }

}
