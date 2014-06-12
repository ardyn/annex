<?php

namespace Ardyn\Annex;

use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store as Session;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Validation\Factory as LaravelValidator;
use Ardyn\Annex\Options\RepositoryInterface as Options;


/**
 * One convenient place to store form element data.
 *
 */
abstract class Validator  {

 /**
  * Options Repository
  *
  * @var \Ardyn\Annex\OptionsRepositoryInterface
  */
  protected $options;

 /**
  * Validator
  *
  * @var \Illuminate\Validation\Validator
  */
  protected $validator;

 /**
  * Input data
  *
  * @var array
  */
  protected $inputData;

 /**
  * Model
  *
  * @var \Illuminate\Database\Eloquent\Model
  */
  protected $model;



 /**
  * Constructor
  *
  * @access public
  * @param \Illumiate\Validation\Factory $validator
  * @param array $inputData
  * @param \Ardyn\Annex\Options $options
  * @param [\Illuminate\Database\Eloquent\Model $model]
  * @return void
  */
  public function __construct(
    LaravelValidator $validator,
    array $inputData,
    Options $options,
    Eloquent $model=null
  ) {

    $this->validator = $validator;
    $this->inputData = $inputData;
    $this->model = $model;
    $this->options = $options;

  } /* function __construct */



 /**
  * Set the model
  *
  * @access public
  * @param \Illuminate\Database\Eloquent\Model $model
  * @return void
  */
  public function setModel(Eloquent $model) {

    $this->model = $model;

  } /* function setModel */



 /**
  * Returns whether the input data is valid
  *
  * @access public
  * @param void
  * @return boolean
  */
  public function passes() {

    $this->validator = $this->validator->make(
      $this->getInputData(),
      $this->getPreparedRules(),
      $this->getMessages()
    );

    return $this->validator->passes();

  } /* function passes */



 /**
  * Returns whether the input data is not valid
  *
  * @access public
  * @param void
  * @return boolean
  */
  public function fails() {

    return ! $this->passes();

  } /* function fails */



 /**
  * Get the prepared validation rules.
  *
  * @return array
  */
  protected function getPreparedRules() {

    return $this->options->rules();

  } /* function getPreparedRules */



 /**
  * Get the custom validation messages.
  *
  * @return array
  */
  protected function getMessages() {

    return $this->options->messages();

  } /* function getMessages */



 /**
  * Get the prepared input data.
  *
  * @return array
  */
  public function getInputData() {

    return $this->inputData;

  } /* function getInputData */



 /**
  * Call methods on the underlying Validator
  *
  * @access public
  * @param string $method
  * @param array $arguments
  * @return mixed
  */
  public function __call($method, $arguments) {

    return call_user_func_array([ $this->validator, $method ], $arguments );

  } /* function __call */

} /* class Validator */

/* EOF */
