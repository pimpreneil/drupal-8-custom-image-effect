<?php

namespace Drupal\custom_image_effect\Plugin\ImageToolkit\Operation\gd;

use Drupal\system\Plugin\ImageToolkit\Operation\gd\GDImageToolkitOperationBase;

/**
 * Defines GD2 Colorize operation.
 *
 * @ImageToolkitOperation(
 *   id = "gd_colorize",
 *   toolkit = "gd",
 *   operation = "colorize",
 *   label = @Translation("Colorize"),
 *   description = @Translation("Colorizes an image.")
 * )
 */
class Colorize extends GDImageToolkitOperationBase {

  /**
   * {@inheritdoc}
   */
  protected function arguments() {
    return array(
      'red' => array('description' => 'red to apply'),
      'green' => array('description' => 'green to apply'),
      'blue' => array('description' => 'blue to apply'),
      'alpha' => array('description' => 'alpha to apply')
    );
  }

  protected function validateArguments(array $arguments) {
      $arguments['red'] = (int) round($arguments['red']);
      $arguments['green'] = (int) round($arguments['green']);
      $arguments['blue'] = (int) round($arguments['blue']);
      $arguments['alpha'] = (int) round($arguments['alpha']);
      return $arguments;
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(array $arguments) {
    // PHP installations using non-bundled GD do not have imagefilter.
    if (!function_exists('imagefilter')) {
      $this->logger->notice("The image '@file' could not be colorized because the imagefilter() function is not available in this PHP installation.", array('@file' => $this->getToolkit()->getSource()));
      return FALSE;
    }

    return imagefilter($this->getToolkit()->getResource(), IMG_FILTER_COLORIZE, $arguments['red'], $arguments['green'], $arguments['blue'], $arguments['alpha']);
  }
}
