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
2024-05-21 20:38:47 (UTC +0): connect
```

# For exemple
You can use :
```shell
tail -f log.txt
```
For view logs un real time

---
You can also save customer information in json format
```php
// logs of connctions
  print_r_logFile([
    'Time' => date("Y-m-d H:i:s") . ' (UTC +0)',
    'IP_client' => $_SERVER['REMOTE_ADDR'],
    'URL' => $_SERVER['REQUEST_URI'],
    'Methode' => $_SERVER['REQUEST_METHOD'],
    'Session' => $_SESSION ?? [],
    'Input' => json_decode(file_get_contents('php://input') ?? []),
    'COOCKIE' => $_COOKIE ?? null,
    'headers' => getallheaders() ?? null
  ], [
    'filename' => 'logs/connect/' . date("Y-m-d H:i:s") . ' ' . bin2hex(random_bytes(2)) . '.json',
    'print_date' => false,
    'separate_character' => '',
    'delete_previous_log' => true,
    'sleep' => false
  ]);
//
```
# Now it's your turn!
