<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Input;

class DatetimeLocal extends Input {

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

    return parent::make($name, $value, 'datetime-local', $attributes);

  } /* function make */

} /* class DatetimeLocal */

/* EOF */
