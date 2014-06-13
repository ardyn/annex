<?php

/**
 * Create a datalist element from the array
 *
 * @access public
 * @param
 * @return string
 */
HTML::macro('datalist', function ($id, array $options, array $attributes=[]) {

  $html = '';

  if ( count($options) == 0 )
    return $thml;

  $attributes['id'] = $id;
  $attributes = HTML::attributes($attributes);

  foreach ($options as $value )
    $html .= '<option value="'.$value.'">';

  return "<datalist{$attributes}>$html</datalist>";

}); /* macro('datalist') */

/* EOF */
