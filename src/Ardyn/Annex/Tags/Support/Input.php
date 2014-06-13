<?php

namespace Ardyn\Annex\Tags\Support;

class Input extends Tag {

 /**
  * Return the input element
  *
  * @access public
  * @param string $name
  * @param string $value
  * @param string $type
  * @param array $attributes
  */
  public function make($name, $value, $type, array $attributes) {

    $expectedValue = $this->getExpectedValue($name, $value);

    return $this->form->input($type, $name, $expectedValue, $attributes);

  } /* function make */

} /* class Input */

/* EOF */
