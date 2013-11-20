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

    public static function multipleMethods(array $where)
    {
        $className = 'Clientes';
        $tableName = static::getEm()->getClassMetadata($className)->getTableName();
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
