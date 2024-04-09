<?php

namespace MyPenTest\Traits;

trait FileUploadTests
{
    protected function testFileUpload($url, $fileParameters, $expectedStatus)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'multipart' => $fileParameters
        ]);

        $this->assertEquals($expectedStatus, $response->getStatusCode());
    }
}