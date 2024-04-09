<?php
namespace MyPenTest\Traits;

trait SqlInjectionTests
{
    protected function testSqlInjection($url, $parameters, $expectedStatus)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'form_params' => $parameters
        ]);

        $this->assertEquals($expectedStatus, $response->getStatusCode());
    }
}
