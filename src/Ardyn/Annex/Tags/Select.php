<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Select extends Tag {

 /**
  * Create a select element
  *
  * @access public
  * @param string $name
  * @param array $options
  * @param array $attributes
  * @retun string
  */
  public function make($name, $options, array $attributes) {

    $selected = $this->form->model ? ( $this->form->model->$name ?: $this->form->options->value($name) ) : null;
    $options = isset($options) ? $options : $this->form->options->options($name);

    $options = array_key_exists('', $options) ? $options : ['' => ''] + $options;

    return $this->form->select($name, $options, $selected, $attributes);

  } /* function make */

} /* class Select */

/* EOF */
