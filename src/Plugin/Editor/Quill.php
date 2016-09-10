<?php

namespace Drupal\quill\Plugin\Editor;

use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;
use Drupal\editor\Plugin\EditorBase;

/**
 * Defines a Quill-based text editor for Drupal.
 *
 * @Editor(
 *   id = "quill",
 *   label = @Translation("Quill"),
 *   supports_content_filtering = FALSE,
 *   supports_inline_editing = FALSE,
 *   is_xss_safe = FALSE,
 * )
 */
class Quill extends EditorBase {

  /**
   * {@inheritdoc}
   */
  public function getDefaultSettings() {
    $settings['default_editor'] = '';
    return $settings;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor) {
    $settings = $editor->getSettings();

    $form['default_editor'] = array(
      '#type' => 'value',
      '#value' => $settings['default_editor'],
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {

    $libraries = [
      'quill/drupal.quill',
    ];
    return $libraries;
  }

  /**
   * {@inheritdoc}
   */
  public function getJSSettings(Editor $editor) {
    $settings = [];
    $settings = $editor->getSettings();
    return $settings;
  }

}
