<?php

class MockTest extends PHPUnit_Framework_TestCase
{
    /**
     * teste para DataTesteFunction
     */
    public function testExample0()
    {
        $mock = $this->getMock('\Paliari\DateTime\TDateTime');
        $mock->expects($this->any())
             ->method('toDateTimeString')
             ->with('Y-m-d H:i:s')
             ->will($this->returnArgument(0));

        $a      = new DataTeste();
        $a->aux = $mock;
        $a->DataTesteFunction();
    }

    /**
     * teste para DataTeste::addTeste
     */
    public function testExample1()
    {
        $context = $this->getMockBuilder('\Paliari\DateTime\TDateTime')
                        ->disableOriginalConstructor()
                        ->getMock();
        $context->expects($this->any())
                ->method('addHour')
                ->will($this->returnArgument(0));

        $token = $this->getMockBuilder('\Paliari\DateTime\TDateTime')
                      ->disableOriginalConstructor()
                      ->getMock();
        $token->expects($this->any())
              ->method('addDay')
              ->will($this->returnValue($context));

        $c             = new DataTeste();
        DataTeste::$em = $token;
        $this->assertEquals(7, $c->addteste(7));
    }

    /**
     * teste para DataTeste::addTeste
     */
    public function testExample2()
    {
        $context = $this->getMockBuilder('DataTeste')
                        ->disableOriginalConstructor()
                        ->setMethods(array ('addDay', 'addHour'))
                        ->getMock();
        $context->expects($this->any())
                ->method('addDay')
                ->will($this->returnSelf());
        $context->expects($this->any())
                ->method('addHour')
                ->will($this->returnArgument(0));

        $c             = new DataTeste();
        DataTeste::$em = $context;
        $this->assertEquals(5, $c->addteste(5));
    }

    /**
     * Teste multipleMethods
     */
    public function testExample3()
    {
        $metaData = $this->getMockBuilder('MetaDatainfo')
                         ->disableOriginalConstructor()
                         ->setMethods(array ('getTableName'))
                         ->getMock();
        $metaData->expects($this->any())
                 ->method('getTableName')
                 ->will($this->returnValue('clientes'));

        $conn = $this->getMock('Connection');
        $conn->expects($this->any())
             ->method('delete')
             ->will($this->returnArgument(0));


        $em = $this->getMockBuilder('EntityManager')
                   ->disableOriginalConstructor()
                   ->setMethods(array ('getClassMetadata', 'getConnection'))
                   ->getMock();
        $em->expects($this->any())
           ->method('getClassMetadata')
           ->will($this->returnValue($metaData));
        $em->expects($this->any())
           ->method('getConnection')
           ->will($this->returnValue($conn));

        $c             = new DataTeste();
        DataTeste::$em = $em;
        $this->assertEquals('clientes', $c->multipleMethods(['id=6']));
    }

    /**
     * Teste multipleMethods
     */
    public function testExample4()
    {
        $metaData = $this->getMockBuilder('MetaDatainfo')
                         ->disableOriginalConstructor()
                         ->setMethods(array ('getTableName'))
                         ->getMock();
        $metaData->expects($this->any())
                 ->method('getTableName')
                 ->will($this->returnValue('clientes'));

        $conn = $this->getMock('Connection');
        $conn->expects($this->any())
             ->method('delete')
             ->will($this->returnArgument(1));


        $em = $this->getMockBuilder('EntityManager')
                   ->disableOriginalConstructor()
                   ->setMethods(array ('getClassMetadata', 'getConnection'))
                   ->getMock();
        $em->expects($this->any())
           ->method('getClassMetadata')
           ->will($this->returnValue($metaData));
        $em->expects($this->any())
           ->method('getConnection')
           ->will($this->returnValue($conn));

        $c             = new DataTeste();
        DataTeste::$em = $em;
        $this->assertEquals(['id=6'], $c->multipleMethods(['id=6']));
    }

    /**
     * Teste auxTableName
     */
    public function testAuxTableName()
    {
        $em = $this->getMockBuilder('EntityManager')
                   ->setMethods(array ('getClassMetadata'))
                   ->getMock();
        $em->expects($this->any())
           ->method('getClassMetadata')
           ->will($this->returnArgument(0));

        $class         = new DataTeste();
        DataTeste::$em = $em;
        $this->assertEquals('DataTeste', $class->getClassMetadata());
    }




/*     * Quando um mock é criado posso utilizar os métodos reais da classe. Verifique o exemplo.
    public function testgetTableName()
    {

        $mt = $this->getMockBuilder('MetaDataInfo')
                    ->setConstructorArgs(['v' => 'table'])
                    ->setMethods(array('getTableName'))
                    ->getMock();

        $mt->expects($this->any())
            ->method('getTableName')
            ->will($this->returnSelf());
        var_export($mt->getTableName()->getTableName1());
    }*/

    /*
     * Other uses example.
        $csc = $this->getMockBuilder('Lightmaker\CloudSearchBundle\Controller\CloudSearchController')
                    ->setConstructorArgs($constructor)
                    ->setMethods(array('handleValue'))
                    ->getMock();

            // Tell the `handleValue` method to return 'bla'
        $csc->expects($this->any())
            ->method('handleValue')
            ->with('bla');*/


}
