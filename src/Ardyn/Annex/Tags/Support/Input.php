<?php

namespace Ardyn\Annex\Tags\Support;

class Input extends Tag {

 /**
  * Return the input element
  *
  * @access public
  * @param string $name
  * @param string $value
  * @param array $attributes
  * @param [string $type]
  */
  public function make($name, $value, array $attributes, $type='text') {

    $default = $this->form->options->value($name);
    $value = $this->form->getValueAttribute($name, $value) ?: $default;

    return $this->form->input($type, $name, $value, $attributes);

  } /* function make */

} /* class Input */

/* EOF */
