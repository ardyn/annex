<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Input;

class Color extends Input {

 /**
  * Create and return the element
  *
  * @access public
  * @param string $name
  * @param string $dummy
  * @param string $value
  * @param array $attributes
  * @return string
  */
  public function make($name, $value, $dummy, array $attributes) {

    return parent::make($name, $value, 'color', $attributes);

  } /* function make */

} /* class Color */

/* EOF */
