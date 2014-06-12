<?php

namespace Ardyn\Annex\Options;

interface RepositoryInterface {

 /**
  * Set the options array
  *
  * @access public
  * @param string $file
  * @return void
  */
  public function initialize($file);

 /**
  * Return label
  *
  * @access public
  * @param string $name
  * @return string
  */
  public function label($name);

 /**
  * Return field_name
  *
  * @access public
  * @param string $name
  * @return string
  */
  public function nameField($name);

 /**
  * Return alias
  *
  * @access public
  * @param string $name
  * @return string
  */
  public function alias($name);

 /**
  * Return type
  *
  * @access public
  * @param string $name
  * @return string
  */
  public function type($name);

 /**
  * Return value
  *
  * @access public
  * @param string $name
  * @return string
  */
  public function value($name);

 /**
  * Return options
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function options($name);

 /**
  * Return attributes
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function attributes($name);

 /**
  * Return the all messages as an array or messages for $name
  *
  * @access public
  * @param [string $name]
  * @return array|string
  */
  public function messages($name=null);

 /**
  * Return the all rules as an array or rule for $name
  *
  * @access public
  * @param [string $name]
  * @return array|string
  */
  public function rules($name=null);

} /* interface RepositoryInterface */

/* EOF */
