<?php

namespace Ardyn\Annex\Tags\Support;

interface TagInterface {

 /**
  * Make the HTML tag
  *
  * @acces public
  * @param string $name
  * @param mixed $selected
  * @param mixed $value
  * @return string
  */
  public function make($name, $value, $selected, array $attributes);

} /* interface TagInterface */

/* EOF */
