# parse

parser


Для корректной работы парсера, на новом месте, нужно:
1. Создать базу данных. Если база есть - переходим к шагу 2.
2. Создать таблицу с произвольным названием, куда парсер будет складывать и откуда брать контент для вывода
3. Указать в файле index.php, после создания нового экземпляра класса bd "$bd = new bd;" параметры для подключения к базе данных, а именно:
  3.1. Хост
  3.2. Имя пользователя
  3.3. Пароль (может быть пустым, то есть если пароль отсутсвует передаем следующее: "$bd->setPassword('');").
  3.4. Имя базы данных.
  
  Также все это можно сделать вызвав соответствующие методы:
    "setHost('sample-host');" - для хоста
    "setUser('user');" - для пользователя
    "setPassword('sample-password');" - для пароля
    "setBd('simple-bd')" - для базы данных
   
  Если вдруг указанные методы не сработают, по какой-то причине - можно явно указать соответствующие свойства класса bd в файле bd.php
  Выглядит это к примеру так:
    public $h = 'localhost';
    public $bd = 'parse';
    public $u = 'root';
    public $p = '';
 
 Также нужно явно указать название таблицы которая ранее была создана и название поля в этой таблице, в файлах index.php и bd.php. Дополнительные методы для этого я могу дописать позже...

4. По остальным методам:
    Метод "connect();" - принимает свойства класса bd указанные в 3 пункте, а именно "$h, $bd, $u, $p" - в том порядке, в котором они указаны тут.
    В случае успеха возвращает массив с двумя ключами, в первом хранится булево значение "true" (можно использовать для проверки состоялось ли подключение), во втором - непосредственно сама информация о подключении которая нужна для дальнейшей работы с базой.
    В случае неудачи - вернет аналогичным образом массив где в первом ключе будет соответсвенно булево значение "false", а во втором информация об ошибке. Выглядит это примерно так:
    
    В первом случае:
      array(
        [0] => true,
        [1] => Возвращает объект возвращаемый mysqli_connect, который содержит информацию о соединении с базой данных
      )
      
     Во втором случае:
      array(
        [0] => false,
        [1] => 'Ошибка подключения' и информацию об ошибке, возвращаемую функцией mysqli_connect_error()
      )
      
      
    Метод "getConnectRezult();" - не принимает ничего, служит для получения результата работы предыдущего метода. Возвращает вышеуказанный массив.
    
    
    Метод "insertInTable();" - принимает имя таблицы, поле куда записать данные в этой таблице, сами данные.
    Выглядит это примерно так:
      insertInTable($table, $fields, $html);
      
      В случае успеха - закрывает соединение и возвращает true.
      В случае ошибки - вернет информацию об ошибке, полученную из метода connect();
      
   Метод getFromTable($table, $fields); - принимает имя таблицы и название поля в этой таблице - откуда нужно вывести данные.
   
      В случае успеха - просто выведет данные и закроет соединение.
      В случае ошибки - вернет информацию об ошибке, полученную из метода connect();
      
====================================================english=============================

For the parser to work correctly, in a new place, you need:
1. Create a database. If there is a base, go to step 2.
2. Create a table with an arbitrary name, where the parser will add and where to get content for output
3. Indicate in the index.php file after creating a new instance of the bd class "$ bd = new bd;" parameters for connecting to the database, namely:
  3.1. Host
  3.2. Username
  3.3. Password (can be empty, that is, if there is no password, we pass the following: "$ bd-> setPassword ('');").
  3.4. The name of the database.
  
  Also, all this can be done by calling the appropriate methods:
    "setHost ('sample-host');" - for host
    "setUser ('user');" - for the user
    "setPassword ('sample-password');" - for password
    "setBd ('simple-bd')" - for the database
   
  If suddenly these methods do not work, for some reason - you can explicitly specify the corresponding properties of the bd class in the bd.php file
  It looks like this:
    public $ h = 'localhost';
    public $ bd = 'parse';
    public $ u = 'root';
    public $ p = '';
 
 You must also explicitly specify the name of the table that was previously created and the name of the field in this table, in the index.php and bd.php files. Additional methods for this I can add later ...

4. For other methods:
    Method "connect ();" - accepts the properties of class bd specified in paragraph 3, namely, "$ h, $ bd, $ u, $ p" - in the order in which they are listed here.
    In case of success, it returns an array with two keys, in the first it stores the Boolean value "true" (you can use it to check whether the connection has taken place), in the second - the connection information itself, which is needed for further work with the database.
    In case of failure, it will return in the same way an array where in the first key there will be a correspondingly Boolean value of "false", and in the second, information about the error. It looks something like this:
    
    In the first case:
      array (
        [0] => true,
        [1] => Returns an object returned by mysqli_connect that contains database connection information
      )
      
     In the second case:
      array (
        [0] => false,
        [1] => 'Connection error' and error information returned by mysqli_connect_error ()
      )
      
      
    Method "getConnectRezult ();" - does not accept anything, serves to obtain the result of the previous method. Returns the above array.
    
    
    Method "insertInTable ();" - takes the name of the table, the field where to write the data in this table, the data itself.
    It looks something like this:
      insertInTable ($ table, $ fields, $ html);
      
      If successful, closes the connection and returns true.
      In case of an error - will return information about the error received from the connect () method;
      
   Method getFromTable ($ table, $ fields); - accepts the name of the table and the name of the field in this table - where to get the data.
   
      If successful, it simply displays the data and closes the connection.
      In case of an error - will return information about the error received from the connect () method;
