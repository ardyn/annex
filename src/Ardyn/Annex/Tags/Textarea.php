<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Textarea extends Tag {

 /**
  * Create and return the element
  *
  * @access public
  * @param string $name
  * @param string $value
  * @param array $attributes
  * @return string
  */
  public function make($name, $value, array $attributes) {

    $default = $this->form->options->value($name);
    $value = $this->form->getValueAttribute($name, $value) ?: $default;

    return $this->form->textarea($name, $value, $attributes);

  } /* function make */

} /* class Textarea */

/* EOF */
