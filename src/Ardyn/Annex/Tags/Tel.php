<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Input;

class Tel extends Input {

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

    return parent::make($name, $value, $attributes, 'tel');

  } /* function make */

} /* class Tel */

/* EOF */
