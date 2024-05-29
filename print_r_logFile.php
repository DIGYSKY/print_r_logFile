<?php

function replacePasswordValue(&$array)
{
  foreach ($array as $key => &$value) {
    if (is_array($value)) {
      replacePasswordValue($value);
    } elseif (is_object($value)) {
      $value = (array) $value;
      replacePasswordValue($value);
    } elseif (
      strpos($key, 'password') !== false
      || (
        strpos($key, 'api') !== false
        && strpos($key, 'key') !== false
      )
    ) {
      $value = md5($value.'print_r_logFile');
    }
  }
}

/**
 * Writes data to a log file in print_r format.
 *
 * This function opens a specified file and writes the provided data in print_r format to the end of the file.
 *
 * This function replace automaticly password value and Api-Key by replacePasswordValue() => md5.
 * 
 * @param mixed $data The data to write to the file. Can be a string, array, or object.
 * @param mixed[] $options An associative array containing the following keys:
 *                         - 'filename'(string): The path of the file to write the data to. Default is 'print_r_logFile.log'.
 *                         - 'delete_previous_log'(bool): Indicates whether the previous content of the file should be deleted before writing new data. Default is false.
 *                         - 'print_date'(bool): Indicates whether the date should be printed in the log.
 *                         - 'separate_character'(string): The character used to separate log entries. Default is PHP_EOL.
 *                         - 'sleep'(bool): set TRUE for stop print logs.
 *                         - 'replace_password'(bool): Replace automaticly password value and Api-Key by random hex (Key contain 'password'). Default is TRUE.
 * @return bool Returns true if the data was successfully written, otherwise false.
 * @link https://github.com/DIGYSKY/print_r_logFile
 */
function print_r_logFile(mixed $data, array $options = []): bool
{
  $filename = (string) ($options['filename'] ?? 'print_r_logFile.log');
  $delete_previous_log = (bool) ($options['delete_previous_log'] ?? false);
  $print_date = (bool) ($options['print_date'] ?? true);
  $separate_character = (string) ($options['separate_character'] ?? PHP_EOL);
  $sleep = (bool) ($options['sleep'] ?? false);
  $replace_password = (bool) ($options['replace_password'] ?? true);

  if (!$sleep) {
    $rewrite = (string) ($delete_previous_log ? 'w' : 'a');
    $file = fopen($filename, $rewrite);

    if ($file === false) {
      return false;
    }

    if (is_array($data) && $replace_password) {
      replacePasswordValue($data);
    }

    $dateTime = (string) date("Y-m-d H:i:s");
    $dataString = is_array($data) || is_object($data) ? json_encode($data) : $data;
    $date = $print_date ? "$dateTime (UTC +0):" : '';
    $success = fwrite($file, "$date $dataString" . $separate_character);

    fclose($file);

    if ($success === false) {
      return false;
    }
  }

  return true;
}
