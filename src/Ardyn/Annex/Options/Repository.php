<?php

namespace Ardyn\Annex\Options;

use BadMethodCallException;
use InvalidArgumentException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Config\Repository as Config;
use Ardyn\Annex\Options\RepositoryInterface;

class Repository implements RepositoryInterface {

 /**
  * Our model options
  *
  * @var array
  */
  private $options=[];

 /**
  * FileSystem
  *
  * @var \Illuminate\\Filesystem\Filesystem
  */
  private $files;



 /**
  * Required columns. Should run this through a Validator.
  *
  * @var array
  */
  private $defaults = [
    'label' => null,        // Label: string
    'rules' => [],          // Validation Rules: string|array
    'type' => 'text',       // Input type: string
                            // See Ardyn/Annex/Tags for available types.
    'attributes' => [],     // Tag attributes: null|array
    'value' => null,        // Default value: null|string
    'messages' => [],       // Validation Messages: string
    'options' => [],        // Additional options: null|array
    'name_field' => null,   // Column name for linked table: null|string
  ];



 /**
  * Constructor
  *
  * @access public
  * @param \Illuminate\Filesystem\Filesystem $files
  * @return void
  */
  public function __construct(
    Filesystem $files,
    Config $config
  ) {

    $this->files = $files;
    $this->config = $config;

  } /* function __construct */



 /**
  * Set the options array
  *
  * @access public
  * @param string $file
  * @return void
  */
  public function initialize($file) {

    // We should validate the config file
    $path = $this->config->get('ardyn/annex::form_file_path') . '/';
    $file = $path . $file . '.php';
    $options = $this->files->getRequire($file);

    // Merge default values into each array row
    foreach ( $options as $key => $option ) {
      $option['alias'] = $key;
      $this->options[$key] = array_merge($this->defaults, $option);
    }

  } /* function setOptions */



 /**
  * Return label
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function label($name) {

    return ( isset($this->options[$name]) and isset($this->options[$name]['label']) )
      ? $this->options[$name]['label']
      : $name;

  } /* function label */



 /**
  * Return field_name
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function nameField($name) {

    return $this->getOptionByKey($name, 'name_field');

  } /* function fieldName */



 /**
  * Return type
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function type($name) {

    return $this->getOptionByKey($name, 'type');

  } /* function type */



 /**
  * Return value
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function value($name) {

    return $this->getOptionByKey($name, 'value');

  } /* function value */



 /**
  * Return options
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function options($name) {

    return $this->getOptionByKey($name, 'options');

  } /* function options */



 /**
  * Return alias
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function alias($name) {

    return $this->getOptionByKey($name, 'alias');

  } /* function alias */



 /**
  * Return attributes
  *
  * @access public
  * @param string $name
  * @return array
  */
  public function attributes($name) {

    return $this->getOptionByKey($name, 'attributes');

  } /* function attributes */



 /**
  * Return the messages as an array or messages for given $name
  *
  * @access public
  * @param [string $name]
  * @return array|string
  */
  public function messages($name=null) {

    if ( is_null($name) )
      return array_dot(array_column($this->options, 'messages', 'alias'));

    return $this->getOptionByKey($name, 'messages');

  } /* function messages */



 /**
  * Return the rules as an array or rules for given $name
  *
  * @access public
  * @param [string $name]
  * @return array|string
  */
  public function rules($name=null) {

    if ( is_null($name) )
      return array_column($this->options, 'rules', 'alias');

    return $this->getOptionByKey($name, 'rules');

  } /* function rules */



 /**
  * Return option identified by $key
  *
  * @access public
  * @param string $name
  * @param string $key
  * @return array|string|closure
  */
  private function getOptionByKey($name, $key) {

    return isset($this->options[$name])
      ? $this->options[$name][$key]
      : $this->defaults[$key];

  } /* function getOptionByKey */

} /* class Repository */

/* EOF */
