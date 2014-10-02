<?php
/**
 * Created by PhpStorm.
 * User: colinwilliams
 * Date: 14-10-02
 * Time: 11:34 AM
 *
 * This Code was inspired by: Jonas John
 * url: http://www.jonasjohn.de/snippets/php/darker-color.htm
 */

function color_darken($color, $dif=20){

  $color = str_replace('#', '', $color);
  if (strlen($color) != 6){ return '000000'; }
  $rgb = '';

  for ($x=0;$x<3;$x++){
    $c = hexdec(substr($color,(2*$x),2)) - $dif;
    $c = ($c < 0) ? 0 : dechex($c);
    $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
  }

  return '#'.$rgb;
}

function color_lighter($color, $dif=20){

  $color = str_replace('#', '', $color);
  if (strlen($color) != 6){ return '000000'; }
  $rgb = '';

  for ($x=0;$x<3;$x++)
  {
    $c = hexdec(substr($color,(2*$x),2)) + $per;
    $c = ($c > 255) ? 'ff' : dechex($c);
    $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
  }
  return '#'.$rgb;
}