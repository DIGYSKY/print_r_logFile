# print_r_logFile
Print_r_logFile writes the contents of a variable to a log file 'log.txt'


## 1 put the file at the root of your project
## 2 in index.php at the beginning of the file
```php
require_once './print_r_logFile.php';
```
## 3 call the function with your variable
```php
print_r_logFile($your_variable);
```
## 4 open log.txt at the project root and magic
```txt
2024-05-21 20:38:47 : connect
```
## Possible options
```php
// 1 your variable; optional : 2 you can specify the name and path of your log file; 3 you can specify whether you want to delete previous logs
print_r_logFile($your_variable, $filename = '/path/to/log.txt', $delete_previous_log = false)
```

# For exemple
You can use :
```shell
tail -f log.txt
```
```php
print_r_logFile([
  'Time' => date("Y-m-d H:i:s").' (UTC +0)',
  'IP client' => $_SERVER['REMOTE_ADDR'],
  'URL' => $_SERVER['REQUEST_URI'],
  'Methode' => $_SERVER['REQUEST_METHOD'],
  'Datas' => $inputLog,
  'Agant' => $_SERVER['HTTP_USER_AGENT'],
  'COOCKIE' => $_COOKIE
], 'logs/connect.json', false, false);
```
For view logs un real time
# Now it's your turn!
