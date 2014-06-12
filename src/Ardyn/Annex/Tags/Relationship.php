<?php

namespace Ardyn\Annex\Tags;

use Ardyn\Annex\Tags\Support\Tag;

class Relationship extends Tag {

 /**
  * Create a checkbox array for with all related model records
  *
  * @access public
  * @param string $name
  * @param string $value
  * @param array $options
  * @return string
  */
  public function make($name, $options, array $attributes) {

    $field = $this->form->options->nameField($name);
    $model = $this->form->model->$name()->getRelated();
    $default = $this->form->options->value($name);
    $elements = [];

    foreach ( $model::lists($field, $model->getKeyName()) as $key => $label ) {

      $checked = $this->form->model->$name->find($key) ? true : $label == $default;

      $elements[] = [
        'tag' => $this->form->checkbox("{$name}[{$key}]", 1, $checked, $attributes),
        'label' => $label,
      ];

    }

    return $this->form->view->make('ardyn/annex::checkbox', compact('elements'))->render();

  } /* function make */

} /* class Relationship */

/* EOF */
