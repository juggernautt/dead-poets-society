<?php

class User
{
    /**
     * Save $this object to database
     * - build SQL string
     * - launch SQL
     * - select the user and return
     */
    public function createAndGet()
    {
        $errors = $this->getErrors();

        if (count($errors) == 0) {
            // generate SQL and save to DB
            //if everything ok select object and return
        } else {
            return false;
        }
    }

    /**
     * Update database with new values
     * - build SQL string
     * - ...
     */
    public function updateAndGet()
    {

    }

    public function getErrors()
    {
        $errors = array();
        return $errors;
    }
}