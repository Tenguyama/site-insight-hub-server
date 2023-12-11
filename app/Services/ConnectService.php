<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\SearchCodeRequest;
use GuzzleHttp\Client;

class ConnectService
{
    protected static $instance;

    protected function __construct(){}

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function searchCode(SearchCodeRequest $request)
    {
        try {
            $url = $request->input('url');
            $html = $this->getFileContents($url);

            //$versatileScriptExists = $this->checkScriptExists($html, 'http://localhost:8080/storage/versatile.js');
            $connectScriptExists = $this->checkScriptExists($html, 'js/connect.js');

            return $connectScriptExists;
            // ['versatileScriptExists' => $versatileScriptExists,
            // 'connectScriptExists' => $connectScriptExists,];
        } catch (\Exception $e) {
            //return $e->getMessage();
            return false;
                //['versatileScriptExists' => false,
                //'connectScriptExists' => false,];
        }
    }









    private function getFileContents(string $url): string
    {
        $client = new Client();
        $response = $client->get($url);

        return $response->getBody()->getContents();
    }

    private function checkScriptExists(string $html, string $scriptSrc): bool
    {
        return strpos($html, '<script src="' . $scriptSrc . '"></script>') !== false;
    }
}
