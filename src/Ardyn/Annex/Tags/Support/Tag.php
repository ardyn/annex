<?php

namespace Ardyn\Annex\Tags\Support;

use Ardyn\Annex\FormBuilder;
use Illuminate\View\Factory as View;
use Illuminate\Config\Repository as Config;
use Ardyn\Annex\Options\Repository as Options;

abstract class Tag implements TagInterface {

 /**
  * Form
  *
  * @var \Ardyn\Annex\FormBuilder
  */
  protected $form;

 /**
  * View
  *
  * @var \Illuminate\View\Factory
  */
  protected $view;

 /**
  * Config Repository
  *
  * @var \Illuminate\Config\Repository
  */
  protected $config;

 /**
  * Form Options Repository
  *
  * @var \Ardyn\Annex\Options\Repository
  */
  protected $options;

 /**
  * Model
  *
  * @var mixed
  */
  protected $model;



 /**
  * Constructor
  *
  * @access public
  * @param \Ardyn\Annex\FormBuilder $form
  * @param mixed $model
  * @param \Illuminate\Config\Repository $config
  * @param \Ardyn\Annex\Options\Repository $options
  * @param \Illuminate\View\Factory $view
  * @return void
  */
  public function __construct(
    FormBuilder $form,
    $model,
    Config $config,
    Options $options,
    View $view
  ) {

    $this->form = $form;
    $this->model = $model;
    $this->config = $config;
    $this->options = $options;
    $this->view = $view;

  } /* function __construct */



  /**
   * Return the expected value for the element
   *
   * @access protected
   * @param string $name
   * @param string $value
   * @return string
   */
  protected function getExpectedValue($name, $value) {

    $default = $this->options->value($name);
    $expectedValue = $this->form->getValueAttribute($name, $value);

    return is_null($expectedValue) ? $default : $expectedValue;

  } /* function getExpectedValue */

} /* class Tag */

/* EOF */
