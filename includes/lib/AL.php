<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');

/**
 * Created by PhpStorm.
 * User: juggernautt
 * Date: 11/14/15
 * Time: 4:14 PM
 *
 *
 * PDO::__construct
 * PDO::prepare
 * PDO::lastInsertedId
 *
 * PDOStatement::execute
 * PDOStatement::fetchAll
 * PDOStatement::fetch
 */
class AL
{
    /**
     * @var PDO $db
     */
    private $db = null;

    /**
     * @param $connection - associative array with connection params (host, user, pass, db_name, charset)
     */
    public function __construct($connection)
    {
        $dsn = "mysql:dbname={$connection['db_name']};host={$connection['host']}";
        $this->db = new PDO($dsn, $connection['user'], $connection['password']);
    }

    /**
     * @param string $table
     * @param int $id
     * @return array | false
     */
    public function select_one($table, $id)
    {
        $pk = $this->pk_field($table);
        $sql = "SELECT * FROM {$table} WHERE {$pk}=?";
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute(array($id));
        return $res ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
    }

    /**
     * @param string $table
     * @return array | false
     */
    public function select_all($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute();
        return $res ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    /**
     * @param string $table
     * @param int $id
     * @param array $props
     * @return array | false
     */
    public function update_one($table, $id, $props)
    {

    }

    public function delete_one($table, $id)
    {
        $pk = $this->pk_field($table);
        $sql = "DELETE FROM {$table} WHERE {$pk}=?";
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute(array($id));
        return $res;
    }

    /**
     * @param $table
     * @param $props
     * @return array | false
     */
    public function insert_one($table, $props)
    {
        $fields = implode(", ", array_keys($props));
        $questions = implode(", ", array_fill(0, count($props), "?"));
        $sql = "INSERT INTO {$table} ({$fields}) VALUES ($questions)";
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute(array_values($props));
        if (!$res) {
            return false;
        }

        $inserted_id = $this->db->lastInsertId();
        return $this->select_one($table, $inserted_id);
    }

    /**
     * @param string $table
     * @return string
     */
    private function pk_field($table)
    {
        return $table[0]."_id";
    }
}