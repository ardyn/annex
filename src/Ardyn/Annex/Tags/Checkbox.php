<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Checkbox extends Tag {

 /**
  * Make the checkbox
  *
  * @access public
  * @param string $name
  * @param string $options
  * @param string $attributes
  * @return string
  */
  public function make($name, $options, array $attributes) {

    $options = $options ?: $this->form->options->options($name);
    $default = $this->form->options->value($name);
    $view = $this->form->config->get('ardyn/annex::checkbox_view');
    $elements = [];

    foreach ( $options as $value => $label ) {

      $checked = $this->form->model ? ( $this->form->model->$name ?: $default == $value ) : false;
      $elements[] = [
        'tag' => $this->form->checkbox("{$name}[{$value}]", 1, $checked, $attributes),
        'label' => $label,
      ];

    }

    return $this->form->view->make($view, compact('elements'))->render();

  } /* function make */

} /* class Checkbox */

/* EOF */
