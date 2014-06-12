<?php

return [

 /**
  * File path where config files are located
  */
  'form_file_path' => app_path('forms'),

 /**
  * Repository to read options
  */
  'options_repository' => 'Ardyn\Annex\Options\Repository',

 /**
  * Regex delimiter
  */
  'regex_delimiter' => '/',

 /**
  * Checkbox view
  */
  'checkbox_view' => 'ardyn/annex::checkbox',

 /**
  * Radio view
  */
  'radio_view' => 'ardyn/annex::radio',

 /**
  * Relationship view
  */
  'relationship_view' => 'ardyn/annex::relationship',

];

/* EOF */
