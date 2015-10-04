<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
/**
 * @return bool|mysqli
 */
function connect()
{
    $connection = mysqli_connect('localhost', 'root', '', 'dead_poets_society');
    if (is_null($connection)) {
        return false;
    }
    mysqli_set_charset($connection, 'utf8');
    return $connection;
}

/**
 * function receives 3 parameters: connection to db, sql string with ? placeholders and array of values.
 * and returns escaped sql string with values embed in a corresponding order
 * @param $conn
 * @param $sql
 * @param $values
 * @return mixed|null
 *
 */
function escape_sql($conn, $sql, $values)
{
    //while there are ? signs in sql string
    while (strpos($sql, "?") !== FALSE) {

        //shift and return the first value of $values array
        $v = array_shift($values);
        if (is_null($v)) {
            return NULL;
        }
        //if value is a string, escape special characters ans add quotes
        if (is_string($v)) {
            $v = mysqli_real_escape_string($conn, $v);
            $v = '"' . $v . '"';
        }
        //replace ? signs in sql string by prepared values
        $sql = preg_replace("/\?/", $v, $sql, 1);
    }

    return $sql;
}


/**
 * @param $sql
 * @param $values
 * @return bool|int
 */
function insert($sql, $values)
{
    $connection = connect();
    if ($connection === FALSE) {
        return FALSE;
    }
    $escaped_sql = escape_sql($connection, $sql, $values);

    mysqli_query($connection, $escaped_sql);

    $insert_id = mysqli_insert_id($connection);
    //if the query did not update an auto increment value.
    if ($insert_id === 0) {
        return FALSE;
    }

    mysqli_close($connection);
    return $insert_id;
}

/**
 * @param $sql
 * @param $values
 * @return bool|int
 */
function update($sql, $values)
{
    $connection = connect();
    if ($connection === FALSE) {
        return FALSE;
    }
    $escaped_sql = escape_sql($connection, $sql, $values);
    mysqli_query($connection, $escaped_sql);

    $affected_rows = mysqli_affected_rows($connection);
    //if query returned an error
    if ($affected_rows == -1) {
        return FALSE;
    }
    mysqli_close($connection);

    return $affected_rows;
}


/**
 * @param $sql
 * @param $values
 * @return bool|int
 */
function delete($sql, $values)
{
    $connection = connect();
    if ($connection === FALSE) {
        return FALSE;
    }
    $escaped_sql = escape_sql($connection, $sql, $values);
    mysqli_query($connection, $escaped_sql);

    $affected_rows = mysqli_affected_rows($connection);
    if ($affected_rows == -1) {
        return FALSE;
    }
    mysqli_close($connection);

    return $affected_rows;
}


/**
 * @param $sql
 * @param array $values
 * @return array|bool
 */
function get_records($sql, $values = array())
{
    $connection = connect();
    if ($connection === FALSE) {
        return FALSE;
    }
    $escaped_sql = escape_sql($connection, $sql, $values);
    $arr = array();

    $result = mysqli_query($connection, $escaped_sql);
    if ($result === FALSE) {
        return FALSE;
    }
    while ($obj = mysqli_fetch_assoc($result)) {
        $arr[] = $obj;
    }

    mysqli_close($connection);
    return $arr;
}

/**
 * @param $sql
 * @param $values
 * @return bool
 */
function get_record($sql, $values)
{
    $r = get_records($sql, $values);
    if (count($r) != 1) {
        return false;
    }
    return $r[0];
}









