<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Select extends Tag {

 /**
  * Create a select element
  *
  * @access public
  * @param string $name
  * @param array $options
  * @param string $selected
  * @param array $attributes
  * @retun string
  */
  public function make($name, $selected, $options, array $attributes) {

    $expectedValue = $this->getExpectedValue($name, $selected);

    $options = isset($options) ? $options : $this->options->options($name);
    $options = array_key_exists('', $options) ? $options : ['' => ''] + $options;

    return $this->form->select($name, $options, $expectedValue, $attributes);

  } /* function make */

} /* class Select */

/* EOF */
