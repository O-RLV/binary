<?php

define('DIR',  pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME) . '/');

function binarySearch ($file, $value) {

  if ($string = file_get_contents($file)) {
    $stringEnc = mb_convert_encoding($string, 'utf-8', 'cp1251');
    $arr = explode('\xOA', $stringEnc);
    array_pop($arr);

    foreach ($arr as $record) {
      $arrRec[] = explode('\t', $record);
    }

    $first = 0;
    $last = count($arrRec) - 1;
    while ($first <= $last) {
      $mid = floor(($first + $last) / 2);
      $compar = strnatcmp($arrRec[$mid][0], $value);
      if ($compar > 0) {
        $last = $mid - 1;
      } elseif ($compar < 0) {
        $first = $mid + 1;
      } else {
        return $arrRec[$mid][1];
      }
    }
    return 'undef';
  }

}

$value = 'ключ5';
$file = DIR .'text.txt';
echo binarySearch($file, $value);

?>
