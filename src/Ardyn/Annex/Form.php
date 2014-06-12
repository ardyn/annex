<?php

namespace Ardyn\Annex;

use Closure;
use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Support\MessageBag;
use Illuminate\Routing\UrlGenerator;
use Illuminate\View\Factory as View;
use Illuminate\Config\Repository as Config;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Ardyn\Annex\Options\RepositoryInterface as Options;

/**
 * One convenient place to store form element data.
 *
 */
class Form extends FormBuilder {

 /**
  * Validation and creation rules
  *
  * @var array
  */
  protected $options;

 /**
  * The view environment instance
  *
  * @var \Illuminate\View\Environment
  */
  protected $view;

 /**
  * The config repository
  *
  * @var \Illuminate\Config\Repository
  */
  protected $config;

 /**
  * Session errors
  *
  * @var \Illuminate\Support\ViewErrorBag
  */
  public $errors;

 /**
  * Template for a form row
  *
  * @var \Closure
  */
  protected $template;



 /**
  * Constructor
  *
  * @access public
  * @param \Illuminate\Html\HtmlBuilder $html
  * @param \Illuminate\Routing\UrlGenerator $url
  * @param string $csrfToken
  * @param \Ardyn\Annex\Options\RepositoryInterface $options
  * @param \Illuminate\View\Factory $view
  * @param \Illuminate\Config\Repository $config
  * @return void
  */
  public function __construct(
    HtmlBuilder $html,
    UrlGenerator $url,
    $csrfToken,
    Options $options,
    View $view,
    Config $config
  ) {

    parent::__construct($html, $url, $csrfToken);

    $this->options = $options;
    $this->view = $view;
    $this->config = $config;

  } /* function __construct */



 /**
  * Open a new form with config options
  *
  * @access public
  * @param string $options
  * @param \Illuminate\Database\Eloquent\Model $model
  * @param \Closure $template
  * @param string $config
  */
  public function open(array $options=[], Eloquent $model=null, $config=null, Closure $template=null) {

    $this->make($config, $model, $template);

    return parent::open($options);

  } /* function register */



 /**
  * Setup our form with a config file and optional model
  *
  * @access public
  * @param string $config
  * @param \Illuminate\Database\Eloquent\Model $model
  * @param \Closure $template
  * @return \Ardyn\Annex\Form
  */
  public function make($config, Eloquent $model=null, Closure $template=null) {

    if ( $config )
      $this->options->initialize($config);

    if ( $model )
      $this->model = $model;

    if ( $template )
      $this->template = $template;

    return $this;

  } /* function make */



 /**
  * Create an HTML label tag
  *
  * @access public
  * @param string $name
  * @param mixed $label
  * @param array $attributes
  * @return string
  */
  public function label($name, $label=null, $attributes=[]) {

    $label = $label ?: $this->options->label($name);

    return parent::label($name, $label, $attributes);

  } /* function label */



 /**
  * Create an HTML input-like element
  *
  * @access public
  * @param string $name
  * @param mixed $value
  * @param array $attributes
  * @param mixed $type
  * @return string
  */
  public function element($name, $value=null, $attributes=[]) {

    $attributes = $this->mergeAttributes($name, $attributes);

    $class = "\Ardyn\Annex\Tags\\".studly_case($this->options->type($name));
    $tag = new $class($this);

    return $tag->make($name, $value, $attributes);

  } /* function tag */



 /**
  * Create HTML elements following the template
  *
  * @access public
  * @param string $name
  * @return string
  */
  public function row($name) {

    return call_user_func($this->template, $this, $name);

  } /* function row */



  /**
   * Set the errors
   *
   * @access public
   * @param \Illuminate\Support\MessageBag $errors
   * @return void
   */
  public function setErrors(MessageBag $errors) {

    $this->errors = $errors;

  } /* function setErrors */



 /**
  * Merge tag attributes.
  *
  * @access private
  * @param string $column
  * @param array $customAttributes
  * @return array
  */
  private function mergeAttributes($column, array $customAttributes) {

    return array_merge(
      $this->options->attributes($column),
      $this->ruleAttribute($this->options->rules($column)),
      $customAttributes
    );

  } /* function mergeAttributes */



 /**
  * Add the validation rules to the tag
  *
  * @access private
  * @param string $rules
  * @return array
  */
  private function ruleAttribute($rules) {

    $attributes = [];

    // Explode rules if not an array
    if ( ! is_array($rules) )
      $rules = explode('|', $rules);

    foreach ( $rules as $rule ) {

      // rule:expected
      if ( preg_match('/(^[a-z_]+):{0,}(.*)$/', $rule, $matches) ) {

        switch ( $matches[1] ) {

          case 'min':
            $attributes['min'] = $matches[2];
            break;
          case 'max':
            $attributes['max'] = $matches[2];
            break;
          case 'size':
            $attributes['maxlength'] = $matches[2];
            break;
          case 'regex':
            $attributes['pattern'] = trim($matches[2], $this->config->get('ardyn/annex::regex_delimiter'));
            break;
          case 'required':
            $attributes[] = 'required';
            break;
          default:
            if ( ! isset($attributes['data-rules']) )
              $attributes['data-rules'] = $matches[0];
            else
              $attributes['data-rules'] .= ' '.$matches[0];
        }
      }
    }

    return $attributes;

  } /* function ruleAttribute */



 /**
  * Allow read access to the protected properties
  *
  * @access public
  * @param string $name
  * @return mixed
  */
  public function __get($name) {

    switch ( $name ) {

      case 'model':   return $this->model;
      case 'options': return $this->options;
      case 'view':    return $this->view;
      case 'config':  return $this->config;

      default:        trigger_error("Undefined property ".__CLASS__."::\${$name}", E_USER_NOTICE);

    }

  } /* function __get */

} /* class Form */

/* EOF */
