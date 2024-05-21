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
```php
// 1 your variable; optional : 2 you can specify the name and path of your log file; 3 you can specify whether you want to delete previous logs
function print_r_logFile($your_variable, $filename = '/path/to/log.txt', $delete_previous_log = false)
```
# Now it's your turn!

