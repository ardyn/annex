<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Input;

class Email extends Input {

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

    return parent::make($name, $value, 'email', $attributes);

  } /* function make */

} /* class Email */

/* EOF */
