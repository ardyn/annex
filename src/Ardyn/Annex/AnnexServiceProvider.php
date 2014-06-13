<?php

namespace Ardyn\Annex;

use Illuminate\Support\MessageBag;
use Ardyn\Annex\Options\Repository;
use Illuminate\Html\HtmlServiceProvider;

class AnnexServiceProvider extends HtmlServiceProvider {

 /**
  * Indicates if loading of the provider is deferred.
  *
  * @var bool
  */
  protected $defer = true;



 /**
  * Boot the service provider.
  *
  * @access public
  * @param void
  * @return void
  */
  public function boot() {

    $this->package('ardyn/annex', 'ardyn/annex');

    $this->app->bind(
      'Ardyn\Annex\Options\RepositoryInterface',
      $this->app['config']['ardyn/annex::options_repository']
    );

    require __DIR__.'/../../macros/html.php';

  } /* function boot */



 /**
  * Register the service provider.
  *
  * @access public
  * @param void
  * @return void
  */
  public function register() {

    $this->registerHtmlBuilder();
    $this->registerOptionsRepository();
    $this->registerFormBuilder();
    $this->registerFormValidator();

  } /* function register */



 /**
  * Register the form-builder config provider.
  *
  * @access protected
  * @param void
  * @return void
  */
  protected function registerOptionsRepository() {

    $this->app->bindShared('form.options', function ($app) {

      return new Repository(
        $app['files'],
        $app['config']
      );

    });

  } /* function registerOptionsRepository */



 /**
  * Register the form-builder provider.
  *
  * @access protected
  * @param void
  * @return void
  */
  protected function registerFormBuilder() {

    $this->app->bindShared('form', function ($app) {

      $form = new FormBuilder(
        $app['html'],
        $app['url'],
        $app['session.store']->getToken(),
        $app['form.options'],
        $app['view'],
        $app['config']
      );

      return $form->setSessionStore($app['session.store']);

    });

  } /* function registerFormBuilder */



 /**
  * Register the form-builder provider.
  *
  * @access protected
  * @param void
  * @return void
  */
  protected function registerFormValidator() {

    $this->app->bindShared('form.validator', function ($app) {

      return new FormValidatorFactory(
        $app['validator'],
        $app['form.options']
      );

    });

  } /* function registerFormValidator */



 /**
  * Get the services provided by the provider.
  *
  * @access public
  * @param void
  * @return array
  */
  public function provides() {

    return [ 'form', 'html', 'form.validator' ];

  } /* function provides */

} /* class AnnexServiceProvider */

/* EOF */
