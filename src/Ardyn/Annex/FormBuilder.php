<?php

namespace Ardyn\Annex;

use Illuminate\Html\HtmlBuilder;
use Illuminate\View\Factory as View;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Html\FormBuilder as Form;
use Illuminate\Config\Repository as Config;
use Ardyn\Annex\Options\RepositoryInterface as Options;

/**
 * One convenient place to store form element data.
 *
 * Concerns: Drop $template? Use a view instead?
 *           We should 'use' FormBuilder instead of extend it?
 *
 */
class FormBuilder extends Form {

 /**
  * Validation and creation rules
  *
  * @var array
  */
  protected $options;

 /**
  * The view environment instance
  *
  * @var \Illuminate\View\Factory
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
    $this->errors = $view->shared('errors');

  } /* function __construct */



 /**
  * Open a new form with config options
  *
  * @access public
  * @param string $options
  * @param string $form
  */
  public function open(array $options=[], $form=null) {

    $this->make($form);

    return parent::open($options);

  } /* function register */



  /**
   * Open a form with a Model
   *
   * @access
   * @param mixed $model
   * @param array $options
   * @param string $form
   * @return void
   */
  public function model($model, array $options=[], $form=null) {

    $this->make($form, $model);

    return parent::model($model, $options);

  } /* function model */



 /**
  * Setup our form with a config file and optional model
  *
  * @access public
  * @param string $form
  * @param mixed $model
  * @return \Ardyn\Annex\FormBuilder
  */
  public function make($form, $model=null) {

    $this->options->initialize($form);
    $this->model = $model;

    return $this;

  } /* function make */



 /**
  * Create an HTML label tag
  *
  * @access public
  * @param string $name
  * @param string $value
  * @param array $options
  * @return string
  */
  public function label($name, $value=null, $options=[]) {

    $label = isset($value) ? $value : $this->options->label($name);

    return parent::label($name, $label, $options);

  } /* function label */



 /**
  * Create an HTML input-like element
  *
  * @access public
  * @param string $name
  * @param mixed $value
  * @param mixed $selected
  * @param array $attributes
  * @return string
  */
  public function element($name, $value=null, $selected=null, $attributes=[]) {

    $attributes = $this->mergeAttributes($name, $attributes);

    $class = "\Ardyn\Annex\Tags\\".studly_case($this->options->type($name));
    $tag = new $class($this, $this->model, $this->config, $this->options, $this->view);

    return $tag->make($name, $value, $selected, $attributes);

  } /* function tag */



 /**
  * Merge tag attributes
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

} /* class FormBuilder */

/* EOF */
