<?php

namespace Ardyn\Annex\Tags\Support;

use Ardyn\Annex\Form;

abstract class Tag implements TagInterface {

 /**
  * Form
  *
  * @var \Ardyn\Annex\Form
  */
  protected $form;


 /**
  * Constructor
  *
  * @access public
  * @param \Ardyn\Annex\Form $form
  * @return void
  */
  public function __construct(Form $form) {

    $this->form = $form;

  } /* function __construct */

} /* class Tag */

/* EOF */
