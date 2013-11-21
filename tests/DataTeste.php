<?php

use Paliari\DateTime\TDateTime;

class DataTeste
{
    /**
     * @var \Paliari\DateTime\TDateTime
     */
    public static $em;

    /**
     *  Utilizado para testes mock
     * @return string
     */
    public function DataTesteFunction()
    {
        $date = static::$em ? static::$em->toDateTimeString('Y-m-d H:i:s') : '';

        return $date;
    }

    /**
     * Utilizado para testes mock
     *
     * @param $v
     *
     * @return TDateTime
     */
    public function addteste($v)
    {
        $date = new TDateTime();
        Teste::Valid($date);

        return static::$em->addDay(2)->addHour($v);
    }

    /**
     * Retorna o nome da classe que está chamando a função
     * @return MetaDataInfo
     */
    public static function getClassMetadata()
    {
        $className = get_called_class();

        return static::getEm()->getClassMetadata($className);
    }

    /**
     * @return string
     */
    public static function getTableName()
    {
        return static::getClassMetadata()->getTableName();
    }

    /**
     * Funcao dependente de outros métodos. Utilizada apenas para testes com mock
     *
     * @param array $where
     *
     * @return int
     */
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
     * @return EntityManager
     */
    public static function getEm()
    {
        return static::$em;
    }
}
