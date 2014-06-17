<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Checkbox extends Tag {

 /**
  * Make the checkbox
  *
  * @access public
  * @param string $name
  * @param array $checked
  * @param array $options
  * @param string $attributes
  * @return string
  */
  public function make($name, $checked, $options, array $attributes) {

    $checked = is_array($checked) ? $checked : $this->options->value($name);
    $options = is_array($options) ? $options : $this->options->options($name);
    $view = $this->config->get('ardyn/annex::checkbox_view');
    $elements = [];

    foreach ( $options as $value => $label )
      $elements[] = $this->createCheckbox($name, $value, $label, $checked, $attributes);

    return $this->view->make($view, compact('elements'))->render();

  } /* function make */



  /**
   * Creates the checkbox
   *
   * @access protected
   * @param string $name
   * @param string $value
   * @param string $label
   * @param array $checked
   * @param array $attributes
   * @return array
   */
  protected function createCheckbox($name, $value, $label, $checked, $attributes) {

    $expectedValue = $this->getExpectedValue($name, $value);
    $isChecked = in_array($expectedValue, $checked);

    return [
      'tag' => $this->form->checkbox("{$name}[{$value}]", 1, $isChecked, $attributes),
      'label' => $label,
    ];

  } /* function createCheckbox */

} /* class Checkbox */

/* EOF */
