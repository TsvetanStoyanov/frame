<?php

namespace Core;

use \PDO;
use \PDOException;


class DB
{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_result, $_count = 0, $_last_insert_id = null;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '', DB_USER, DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $exeption) {
            die($exeption->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function query($sql, $params = [], $class = false)
    {
        $this->_error = false;

        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {
                if ($class) {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_CLASS, $class);
                } else {
                    $this->_result = $this->_query->fetchALL(PDO::FETCH_OBJ);
                }
                $this->_count = $this->_query->rowCount();
                $this->_last_insert_id = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    protected function _read($table, $params = [], $class)
    {
        $condition_string = '';
        $bind = [];
        $order = '';
        $limit = '';

        //conditions
        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as  $condition) {
                    $condition_string .= ' ' . $condition . ' AND';
                }
                $condition_string = trim($condition_string);
                $condition_string = rtrim($condition_string, ' AND');
            } else {
                $condition_string = $params['conditions'];
            }
            if ($condition_string != '') {
                $condition_string = ' WHERE ' . $condition_string;
            }
        }

        // binding
        if (array_key_exists('bind', $params)) {
            $bind = $params['bind'];
            // d($params);
        }

        // order
        if (array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }

        // limit
        if (array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }

        $sql = "SELECT * FROM {$table}{$condition_string}{$order}{$limit}";
        // var_dump($sql);
        if ($this->query($sql, $bind, $class)) {
            if (!count($this->_result)) return false;
            return true;
        }
        return false;
    }

    public function find($table, $params = [], $class = false)
    {
        if ($this->_read($table, $params, $class)) {

            return $this->results();
        }
        return false;
    }

    public function find_first($table, $params = [], $class = false)
    {
        if ($this->_read($table, $params, $class)) {
            return $this->first();
        }
        return false;
    }

    public function insert($table, $fields = [])
    {
        $fieldString = '';
        $valueString = '';
        $values = [];
        foreach ($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value;
        }

        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }


    public function update($table, $id, $fields = [])
    {
        $fieldString = '';
        $values = [];
        foreach ($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = trim($fieldString, ',');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";

        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }


    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";

        if (!$this->query($sql)->error()) {
            return true;
        }
        return false;
    }

    // return result from query
    public function results()
    {
        return $this->_result;
    }

    // return first element from query
    public function first()
    {
        return (!empty($this->_result)) ? $this->_result[0] : [];
    }

    public function count()
    {
        return $this->_count;
    }

    //SHOW PROPARTIES FROM TABLE
    public function get_columns($table)
    {
        return $this->query("Show columns from {$table}")->results();
    }

    public function lastID()
    {
        return $this->_last_insert_id;
    }


    public function error()
    {
        return $this->_error;
    }
}
