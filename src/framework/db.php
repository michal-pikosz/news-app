<?php

namespace src\framework;

use mysqli;

/**
 * Class db
 * @package src\framework
 *
 * A simple class used to query the database
 */
class db
{

    protected mysqli $connection;
    protected $query;
    protected bool $show_errors = TRUE;
    protected bool $query_closed = TRUE;
    public int $query_count = 0;

    public function __construct($dbhost = 'mysql', $dbuser = 'rootuser', $dbpass = 'password', $dbname = 'panda_news', $charset = 'utf8')
    {
        $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($this->connection->connect_error) {
            $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
        $this->connection->set_charset($charset);
    }

    /**
     * Maps variables to a query and executes them
     * @param $query
     * @return $this
     */
    public function query($query): db
    {
        if (!$this->query_closed) {
            $this->query->close();
        }
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x        = func_get_args();
                $args     = array_slice($x, 1);
                $types    = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types      .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types      .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                unset($arg, $a);
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                $this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
            }
            $this->query_closed = FALSE;
            $this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
        }
        return $this;
    }


    /**
     * Returns many results from the database
     * @param null $callback
     * @return array
     */
    public function fetchAll($callback = null): array
    {
        [$row, $result] = $this->fetchSetup();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback !== null && is_callable($callback)) {
                $value = $callback($r);
                if ($value === 'break') {
                    break;
                }
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }


    /**
     * Returns one item from the database
     * @return array
     */
    public function fetchArray(): array
    {
        [$row, $result] = $this->fetchSetup();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    public function close(): bool
    {
        return $this->connection->close();
    }

    public function numRows()
    {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function affectedRows()
    {
        return $this->query->affected_rows;
    }

    public function lastInsertID()
    {
        return $this->connection->insert_id;
    }

    public function error($error): void
    {
        if ($this->show_errors) {
            $_SESSION['error'] = [$error];
            Log::info("MYSQL ERROR", ["message" => $error]);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    private function _gettype($var): string
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

    /**
     * @return array[]
     */
    public function fetchSetup(): array
    {
        $params = array();
        $row    = array();
        $meta   = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        return array($row, $result);
    }

}