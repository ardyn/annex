<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Radio extends Tag {

 /**
  * Create an array of radio buttons
  *
  * @access public
  * @param string $name
  * @param array $options
  * @param array $attributes
  * @return string
  */
  public function make($name, $options, array $attributes) {

    $options = $this->form->options->options($name);
    $default = $this->form->options->value($name);
    $value = $this->form->model ? $this->form->model->$name : null;
    $elements = [];
    $view = $this->form->config->get('ardyn/annex::radio_view');

    foreach ( $options as $key => $label ) {

      $checked = $value ?: $default == $key;
      $elements[] = [
        'tag' => $this->form->radio($name, $key, $checked, $attributes),
        'label' => $label,
      ];

    }

    return $this->form->view->make($view, compact('elements'))->render();

  } /* function make */

} /* class Radio */

/* EOF */
