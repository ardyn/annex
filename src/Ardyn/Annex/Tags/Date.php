<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Input;

class Date extends Input {

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

    return parent::make($name, $value, $attributes, 'date');

  } /* function make */

} /* class Date */

/* EOF */
