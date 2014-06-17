# Laravel Form Extension

This package is in BETA stage! Apt to change quite a bit. Use with caution.

Annex allows us to build HTML forms using a config file to represent the form fields. Within this config file, we have the column type, label, and validation rules.
Package also comes with a Validator class to valide the input against the rules defined in our config file.

## Installation

Update your application's `composer.json` file, add  the service providers and add aliases in `app/config/app.php`, then publish configuration files.

### Composer

Update your `composer.json` file to include the following:

```json
"require": {
  "ardyn/annex": "dev-master"
}
"repositories": [
  {
    "type": "git",
    "url": "https://github.com/ardyn/annex.git"
  }
]
```

### Update Service Provider

Add the following to the list of service providers in `app/config/app.php`:

```php
'providers' = [
  'Ardyn\Annex\AnnexServiceProvider',
];
```

Comment out the `'Illuminate\Html\HtmlServiceProvider'` service provider as `AnnexServiceProvider` extends `HtmlServiceProvider`.

### Add Alaises

Add the following to the list of aliases in `app/config/app.php`:

```php
'aliases' = [
    'FormValidator'   => 'Ardyn\Annex\Facades\FormValidator',
];
```

Since we are overriding `form` in the IoC container, we won't need to re-alias the `Form` facade.

### Publish Configuration Files

From the command line, run `php artisan config:publish ardyn/annex`, then edit the config files in `app/config/packages/ardyn/annex/`.

## Usage

Create a config file for each form and store in the `form_file_path` directory denoted in the `config.php` file.
Create a class that extends `Ardyn\Annex\FormValidator` to validate against the config file.

### Example config file

Filename: `form.php`

```php
<?php

## More options available in Ardyn\Annex\Options\Repository.php

return [

  'name' => [
    'label' => 'First Name',
    'type' => 'text',
    'attributes' => [
      'autofocus',
      'placeholder' => 'First Name',
    ],
    'rules' => 'required|alpha|max:30',
    'messages' => [
      'required' => 'You don\'t have a name?',
      'alpha' => 'Weird name, dude.',
    ],
    'value' => 'Bob', # A default value
  ],

];
```

### Example Template

In your code, you may initialize a form by including the config file name in the `Form::open` method.
`Form::model()` is supported as well.

```php
echo Form::open([ 'url' => '#' ], 'form');
echo Form::label('name');
echo Form::element('name');
echo Form::close();
```

And the generated HTML

```html
<form method="POST" action="#" accept-charset="UTF-8">
<label for="name">First Name</label>
<input autofocus="autofocus" placeholder="First Name" required="required" data-rules="alpha" max="30" name="name" type="text" value="Bob" id="name"></div>
</form>
```

### Form::element()

Annex' element method has a slight variation in Laravel's FormBuilder methods (input, checkbox, radio, select).

The function prototype is as follows;

```php
/**
 * Create an HTML input-like element
 * Can return any of input, checkbox, radio, or select
 *
 * @access public
 * @param string $name       name attribute
 * @param mixed  $value      value attribute
 * @param mixed  $options    available values for value attribute
 * @param array  $attributes additional HTML tag attributes
 * @return string
 */
public function element($name, $value=null, $options=null, $attributes=[]);
public function element($name, $value=null, $options=null, $attributes=[]);
```

## Validating Forms

```php
$validator = FormValidator::make('MyFormValidator', 'form', Input::all());

if ( $validator->passes() )
  echo 'Passed!';
else if ( $validator->fails() )
  return Redirect::back()->withErrors($validator->errors())->withInput();
```

## TODO

* Separate form validation and form building into different packages(?)
* Add aliases for our input fields
* Write tests
* Proofread!
* Refactor, again and again.
* Update 'relationship' type.
* Test Form::model()
