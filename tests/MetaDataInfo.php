<?php

class MetaDataInfo
{
    public $tableName;

    public function __construct($v)
    {
        $this->tableName = $v;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return strtolower($this->tableName);
    }

    public function getTableName1()
    {
        return $this->tableName;
    }
}