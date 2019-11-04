<?php

namespace Drupal\cloudfront_path_invalidate\controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

class CloudfrontPathInvalidateController  extends ControllerBase{
  public function invalidate() {
    $data['my_table'] = [
      '#type' => 'table',
      '#caption' => $this->t('My Table'),
      '#header' => ['Header'],
    ];

    $data['my_table'][1]['my_text_field'] = [
      '#type' => 'textfield',
      '#title' => $this->t('My text field'),
      '#title_display' => 'invisible',
    ];

    return $data;
  }
  public function cdnkeys() {
    return array(
      '#type' => 'markup',
      '#markup' => t('Hello, World2!'),
    );
  }
}
