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
  * @param string $dummy
  * @param array $attributes
  * @return string
  */
  public function make($name, $value, $dummy, array $attributes) {

    $expectedValue = $this->getExpectedValue($name, $value);

    return $this->form->textarea($name, $expectedValue, $attributes);

  } /* function make */

} /* class Textarea */

/* EOF */
