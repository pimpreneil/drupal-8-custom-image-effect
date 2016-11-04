<?php
/**
 * @file
 * Contains \Drupal\custom_image_effect\Plugin\ImageEffect\CustomColorizeImageEffect
 */
 
namespace Drupal\custom_image_effect\Plugin\ImageEffect;
 

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Image\ImageInterface;
use Drupal\image\ConfigurableImageEffectBase;
 
/**
 * This effect allows for colorizing a picture
 *
 * @ImageEffect(
 *   id = "custom_colorize",
 *   label = "Custom colorize",
 *   description = "Allows for colorizing picture"
 * )
 */

class CustomColorizeImageEffect extends ConfigurableImageEffectBase {
  public function applyEffect(ImageInterface $image) {
      if(!$image->getToolkit()->apply('colorize', array(
          'red' => $this->configuration['red'],
          'green' => $this->configuration['green'],
          'blue' => $this->configuration['blue'],
          'alpha' => $this->configuration['alpha']
      ))) {
        return FALSE;
      }
      return TRUE;
  }

  public function getSummary() {
    $summary = array(
      '#theme' => 'custom_colorize_summary',
      '#data' => $this->configuration,
    );
    $summary += parent::getSummary();

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'red' => NULL,
      'green' => NULL,
      'blue' => NULL,
      'alpha' => NULL
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['red'] = array(
      '#type' => 'number',
      '#title' => t('red'),
      '#default_value' => $this->configuration['red'],
      '#required' => TRUE,
      '#min' => -255,
      '#max' => 255,
    );
    $form['green'] = array(
      '#type' => 'number',
      '#title' => t('green'),
      '#default_value' => $this->configuration['green'],
      '#required' => TRUE,
      '#min' => -255,
      '#max' => 255,
    );
    $form['blue'] = array(
      '#type' => 'number',
      '#title' => t('blue'),
      '#default_value' => $this->configuration['blue'],
      '#required' => TRUE,
      '#min' => -255,
      '#max' => 255,
    );
    $form['alpha'] = array(
      '#type' => 'number',
      '#title' => t('alpha'),
      '#default_value' => $this->configuration['alpha'],
      '#required' => TRUE,
      '#min' => -127,
      '#max' => 127,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);

    $this->configuration['red'] = $form_state->getValue('red');
    $this->configuration['green'] = $form_state->getValue('green');
    $this->configuration['blue'] = $form_state->getValue('blue');
    $this->configuration['alpha'] = $form_state->getValue('alpha');
  }
}
