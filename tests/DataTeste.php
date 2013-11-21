<?php

use Paliari\DateTime\TDateTime;

class DataTeste
{
    /**
     * @var \Paliari\DateTime\TDateTime
     */
    public static $em;

    public function DataTesteFunction()
    {
        $date = static::$em ? static::$em->toDateTimeString('Y-m-d H:i:s') : '';

        return $date;
    }

    public function addteste($v)
    {
        $date = new TDateTime();
        Teste::Valid($date);

        return static::$em->addDay(2)->addHour($v);
    }

    /**
     * @return MetaDataInfo
     */
    public static function auxTableName()
    {
        $className = get_called_class();
        return static::getEm()->getClassMetadata($className);
    }

    public static function getTableName()
    {
        return static::auxTableName()->getTableName();
    }

    public static function multipleMethods(array $where)
    {

        $tableName = static::getTableName();
        $conn      = static::getEm()->getConnection();
        try {
            $ret = $conn->delete($tableName, $where);

            return $ret;
        } catch (Exception $e) {
            echo new MyException("$e");
        }
        echo 'fim';
    }

    /**
     *  @return EntityManager
     */
    public static function getEm()
    {
        return static::$em;
    }
}
