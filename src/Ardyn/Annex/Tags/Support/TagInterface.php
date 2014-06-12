<?php

namespace Ardyn\Annex\Tags\Support;

interface TagInterface {

 /**
  * Make the HTML tag
  *
  * @acces public
  * @param string $name
  * @param mixed $value
  * @return string
  */
  public function make($name, $value, array $attributes);

} /* interface TagInterface */

/* EOF */
