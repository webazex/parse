<?php

/**
 * Created by PhpStorm.
 * User: Webazex
 * Date: 08.02.2020
 * Time: 09:28
 */
class bd
{
    public $h = 'localhost';
    public $bd = 'parse';
    public $u = 'root';
    public $p = '';

    public $table = 'data';

//    getters and setters
    public function getBd()
    {
        return $this->bd;
    }

    public function getHost()
    {
        return $this->h;
    }

    public function getPassword()
    {
        return $this->p;
    }

    public function getUser()
    {
        return $this->u;
    }

//    setters
    public function setBd($bd)
    {
        $this->bd = $bd;
    }

    public function setHost($h)
    {
        $this->h = $h;
    }

    public function setPassword($p)
    {
        $this->p = $p;
    }

    public function setUser($u)
    {
        $this->u = $u;
    }

    public function connect($h, $bd, $u, $p)
    {
        $con = mysqli_connect($h, $u, $p, $bd);
        if ($con == false) {
            return array(
                0 => false,
                1 => 'Ошибка подключения' . mysqli_connect_error()
            );
        } else {
            return array(
                0 => true,
                1 => $con
            );
        }
    }

    public function getConnectRezult()
    {
        $rezult = $this->connect($this->h, $this->bd, $this->u, $this->p);
        return $rezult;
    }

    public function insertInTable($table, $fields, $html)
    {
        $con = $this->getConnectRezult();
        if ($con == true) {
            $success = $con[1];
            $values = $html;
            $values = mysqli_escape_string($success, $values);
            $values = '\'' . $values . '\'';
            $query = "INSERT INTO `$table` (`id`, `$fields`) VALUES (NULL, $values)";
            if (mysqli_query($success, $query)) {
                return true;
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($success);
            }
            mysqli_close($success);
        } else {
            return $this->success;
        }
    }

    public function getFromTable($table, $fields)
    {
        $con = $this->getConnectRezult();
        if ($con == true) {
            $success = $con[1];
            $query = "SELECT `$fields` FROM `$table`";
            $q = mysqli_query($success, $query);
            if (!$q) {
                echo "Error: " . $query . "<br>" . mysqli_error($success);
            } else {
                $return = mysqli_fetch_assoc($q);
                while ($return = mysqli_fetch_assoc($q)) {
                    $v = array_values($return);
//                    $rezult = htmlspecialchars($v[0]);
                    echo('<div class="stocks-container">' . $v[0] . '</div>');
                }
//                не отработает так как нет +1
                while ($return = mysqli_fetch_assoc($q)) {
                    $v = array_values($return);
//                    $rezult = htmlspecialchars($v[0]);
                    echo('<div style="margin: 20px auto; width: 80%;">' . $v[0] . '</div>');
                }

            }
            mysqli_close($success);
        } else {
            return $this->success;
        }

    }
}