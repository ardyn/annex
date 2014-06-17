<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Radio extends Tag {

 /**
  * Create an array of radio buttons
  *
  * @access public
  * @param string $name
  * @param array $options
  * @param string $checked
  * @param array $attributes
  * @return string
  */
  public function make($name, $checked, $options, array $attributes) {

    $options = is_array($options) ? $options : $this->options->options($name);
    $default = isset($checked) ? $checked : $this->options->value($name);
    $expectedValue = $this->getExpectedValue($name, $default);
    $view = $this->config->get('ardyn/annex::radio_view');
    $elements = [];

    foreach ( $options as $key => $label )
      $elements[] = $this->createRadioButton($name, $key, $label, $expectedValue, $attributes);

    return $this->view->make($view, compact('elements'))->render();

  } /* function make */



  /**
   * Create a radio button
   *
   * @access protected
   * @param string $name
   * @param string $key
   * @param string $label
   * @param mixed $expectedValue
   * @param array $attributes
   * @return array
   */
  protected function createRadioButton($name, $key, $label, $expectedValue, $attributes) {

    $checked = ($expectedValue == $key);

    return [
      'tag' => $this->form->radio($name, $key, $checked, $attributes),
      'label' => $label,
    ];

  } /* function createRadioButton */

} /* class Radio */

/* EOF */
