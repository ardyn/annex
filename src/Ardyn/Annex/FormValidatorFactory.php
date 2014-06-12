<?php

namespace Ardyn\Annex;

use Ardyn\Annex\AbstractValidator;
use Ardyn\Annex\Options\Repository as Options;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Database\Eloquent\Model as Eloquent;

class FormValidatorFactory {

 /**
  * Constructor
  *
  * @access public
  * @param \Illuminate\Validation\Factory $validator
  * @param \Ardyn\Annex\Options $options
  * @return void
  */
  public function __construct(
    Validator $validator,
    Options $options
  ) {

    $this->validator = $validator;
    $this->options = $options;

  } /* function __construct */



 /**
  * Returns an extended instance of AbstractValidator
  *
  * @access public
  * @param string $form
  * @param sring $config
  * @param array $data
  * @param \Illuminate\Database\Eloquent\Model [$model]
  * @return \Ardyn\Annex\AbstractValidator
  */
  public function make($form, $config, $data, Eloquent $model=null) {

    $this->options->initialize($config);

    return new $form(
      $this->validator,
      $data,
      $this->options,
      $model
    );

  } /* function make */

} /* class FormValidatorFactory */

/* EOF */
