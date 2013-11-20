<?php

require_once "PHPUnit/Framework.php";

class FilesMultiplier
{
    /**
     * Read pairs of numbers from a file, mutiply, and output to
     * another file.
     */
    public function multiply($inputFile, $outputFile)
    {
        $line = $inputFile->read();
        while ($line !== null) {
            $parts  = explode(" ", $line);
            $a      = (integer)$parts[0];
            $b      = (integer)$parts[1];
            $result = ($a * $b);
            $outputFile->write($result);

            $line = $inputFile->read();
        }
    }
}

class TestFilesMultiplier extends PHPUnit_Framework_TestCase
{
    public function test_multiply()
    {
        $multiplier = new FilesMultiplier();
        /**
         * We pretend that FileObject is defined somewhere
         * else in our project.  Note that PHPUnit will mock
         * out any given name, even if it does not have a class
         * to base the mock on.
         */
        $inputFile = $this->getMock('FileObject',
                                    array ('read'));
        /**
         * To assert across several calls to a function,
         * use $this->at() with a zero-based index.
         */
        $inputFile->expects($this->at(0))
                  ->method('read')
                  ->will($this->returnValue("3 4"));
        $inputFile->expects($this->at(1))
                  ->method('read')
                  ->will($this->returnValue("4 6"));
        $inputFile->expects($this->at(2))
                  ->method('read')
                  ->will($this->returnValue(null));
        /**
         * Be sure to put this count expectation AFTER any index
         * expectations.  If you put it before, the test will fail.
         */
        $inputFile->expects($this->exactly(3))
                  ->method('read');
        /**
         * Another issue with PHPUnit... you can set an expectation
         * on a misspelled function not previously mocked out.
         * So, this works.
         */
        $inputFile->expects($this->any())
                  ->method('red');
        $inputFile->expects($this->never())
                  ->method('red');

        $outputFile = $this->getMock('FileObject',
                                     array ('write'));
        /** Interestingly, this works here. */
        $outputFile->expects($this->exactly(2))
                   ->method('write');
        /**
         * Note the difference in type here.
         * with() uses $this->isEqual() (i.e. ==) by default
         */
        $outputFile->expects($this->at(0))
                   ->method('write')
                   ->with("12");
        /**
         * If you want identical (i.e. ===), you can specify it.
         */
        $outputFile->expects($this->at(1))
                   ->method('write')
                   ->with($this->identicalTo(24));

        $multiplier->multiply($inputFile, $outputFile);
    }
}