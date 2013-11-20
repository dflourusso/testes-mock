<?php

class EntityManager
{
    /**
     * @param $param
     *
     * @return string|MetaDataInfo
     */
    public function getClassMetadata($param)
    {
        $mtData = new MetaDataInfo($param);
        return $mtData;
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return new Connection();
    }
}
