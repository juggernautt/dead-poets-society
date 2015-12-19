<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');


class AL
{
    /**
     * @var PDO $db
     */
    private $db = null;

    /**
     * creates a PDO instance representing a connection to a database
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

    public function array_with_keys($arr) {
        $res = array();
        foreach($arr as $k=>$v) {
            $res[] = "$k=?";
        }
        return $res;
    }


    public function select_many($table, $predicates)
    {
        $preds = $this->array_with_keys($predicates);
        $sql = "SELECT * FROM {$table} WHERE " . implode(' AND ', $preds);
        $stmt = $this->db->prepare($sql);
        $values = array_values($predicates);
        $res = $stmt->execute($values);
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
        $updates = $this->array_with_keys($props);
        $pk = $this->pk_field($table);
        $sql = "UPDATE $table SET ".implode(',', $updates)." WHERE $pk=?";
        $stmt = $this->db->prepare($sql);

        $values = array_values($props);
        array_push($values, $id);
        $res = $stmt->execute($values);

        return $res ? $this->select_one($table, $id) : false;
    }

    /**
     * @param string $table
     * @param array $predicates
     * @param array $props
     * @return boolean
     */
    public function update_many($table, $predicates, $props)
    {
        $updates = $this->array_with_keys($props);
        $preds = $this->array_with_keys($predicates);

        $sql = "UPDATE {$table} SET " . implode(',', $updates) . " WHERE " . implode(' AND ', $preds);
        $stmt = $this->db->prepare($sql);

        $mergedValues = array_merge(array_values($props), array_values($predicates));
        $res = $stmt->execute($mergedValues);
        return $res;

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
     * @param string $table
     * @param array $predicates
     * @return boolean
     */
    public function delete_many($table, $predicates)
    {
        $preds = $this->array_with_keys($predicates);

        $sql = "DELETE FROM {$table} WHERE " . implode(' AND ', $preds);
        $stmt = $this->db->prepare($sql);
        $values = array_values($predicates);
        $res = $stmt->execute($values);
        return $res;

    }


    /**
     * @param string $sql
     * @param array $values
     * @return array | boolean
     */
    public function query($sql, $values)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $table
     * @param $props
     * @return array | false
     */
    public function insert_one($table, $props)
    {
        $fields = implode(", ", array_keys($props)); // "key1,key2,..."
        $questions = implode(", ", array_fill(0, count($props), "?")); // "?,?,?..."
        $sql = "INSERT INTO $table ($fields) VALUES ($questions)";
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
    public function pk_field($table)
    {
        return $table[0]."_id";
    }
}