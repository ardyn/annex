# Laravel Form Extention

This package is in BETA stage! Apt to change quite a bit. Use with caution; don't judge.

Should be working with L4.2, but input types and Eloquent hasn't been tested.

Annex allows us to build HTML forms using a config file to represent the form fields. Within this config file, we have the column type, label, and validation rules. Package also comes with a Validator class to valide the input against the rules defined in our config file.

## Installation

Update `composer.json`, update the service providers and add aliases in `app/config/app.php`, then publish configuration files.
<b></b>
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

Since this package's `Form` class is extending Laravel's `Form` facade, you'll want to comment out the `'Illuminate\Html\HtmlServiceProvider'` service provider.

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

### Example Blade template

In your code, you may initialize a form by including the config file name in the `Form::open` method.

```php
{{ Form::open([ 'url' => '#' ], null, 'form') }}
{{ Form::label('name') }} {{ Form::element('name') }}
{{ Form::close() }}
```

And the generated HTML

```html
<form method="POST" action="#" accept-charset="UTF-8">
<label for="name">First Name</label> <input autofocus="autofocus" placeholder="First Name" required="required" data-rules="alpha" max="30" name="name" type="text" value="Bob" id="name"></div>
</form>
```

## Validating Forms

```php
$validator = FormValidator::make('contact_form');

if ( $validator->passes() )
  echo 'Passed!';
else if ( $validator->fails() )
  return Redirect::back()->withErrors($validator->errors())->withInput();
```

## TODO

* Add aliases for our input fields
* Write tests
* Update README
* Refactor, again and again.
