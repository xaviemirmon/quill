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
 *   supported_element_types = {
 *     "textarea"
 *   }
 * )
 */
class Quill extends EditorBase {

  /**
   * {@inheritdoc}
   */
  public function getDefaultSettings() {
    $settings = [
      'paste_without_formatting' => FALSE,
      'placeholder' => 'Compose an epic...',
      'theme' => 'snow',
    ];
    return $settings;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor) {
    $settings = $editor->getSettings();

    $form['placeholder'] = [
      '#title' => $this->t('Placeholder'),
      '#type' => 'textfield',
      '#default_value' => $settings['placeholder'],
    ];

    $form['theme'] = [
      '#title' => $this->t('Theme'),
      '#type' => 'select',
      '#default_value' => $settings['theme'],
      '#options' => [
        'bubble' => 'Bubble',
        'snow' => 'Snow',
      ],
    ];

    $form['paste_without_formatting'] = [
      '#title' => $this->t('Paste Without Formatting'),
      '#type' => 'checkbox',
      '#default_value' => $settings['paste_without_formatting'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    $settings = $editor->getSettings();

    $libraries = [
      'quill/drupal.quill',
    ];

    switch ($settings['theme']) {
      case 'bubble':
        $libraries[] = 'quill/quill.bubble';
        break;

      case 'snow':
        $libraries[] = 'quill/quill.snow';
        break;
    }

    return $libraries;
  }

  /**
   * {@inheritdoc}
   */
  public function getJSSettings(Editor $editor) {
    return $editor->getSettings();
  }

}
