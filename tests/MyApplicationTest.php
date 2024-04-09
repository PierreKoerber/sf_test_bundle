<?php 

use PHPUnit\Framework\TestCase;
use MyPenTest\Traits\FileUploadTests;
use MyPenTest\Traits\SqlInjectionTests;

class MyApplicationTest extends TestCase
{
    use FileUploadTests;
    use SqlInjectionTests;

    public function testUpload()
    {

       $this->log("START") ;
        $url = 'my url';
        $fileParameters = [
            [
                'name' => 'file',
                'contents' => fopen('files/fake.pdf', 'r')
            ]
        ];


        dump($fileParameters) ;

        $this->log("START file upload") ;
        $this->testFileUpload($url, $fileParameters, 422);

        $this->log("next") ;
        $fileParameters = [
            [
                'name' => 'file',
                'contents' => fopen('files/file1.pdf', 'r')
            ]
        ];
        $this->testFileUpload($url, $fileParameters, 200);

    }

    public function testSqlInjection()
    {
        $url = 'http://myapp/api';
        $parameters = ['id' => '1; DROP TABLE users;'];
        $this->testSqlInjection($url, $parameters, 500);
    }

    public function log($msg){
        echo $msg."\n";

    }
}
