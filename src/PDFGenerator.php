<?php

namespace Valsty\CloudPdf;

use GuzzleHttp\Client;

class PDFGenerator
{
    /**
     * @var Client
     */
    public $client;

    public function __construct($apiKey)
    {
        $this->client = new Client([
            'base_uri' => 'https://cloudpdf.dev',
            'headers' => [
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @param $html string The html to be converted into pdf.
     * @param $filename string The file will be downloaded with this given name.
     * @return string|bool Return's the download url. Return's false on error.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fromHtml(string $html, string $filename)
    {
        try {
            $response = $this->client->post('/api/pdf/generate', [
                'form_params' => [
                    'html' => $html,
                    'filename' => $filename,
                ],
            ]);

            return json_decode($response->getBody()->getContents())->download_url;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param $url string A publicly accessible url to be converted into pdf.
     * @param $filename string The file will be downloaded with this given name
     * @return string|bool Return's the download url. Return's false on error.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fromUrl(string $url, string $filename)
    {
        try {
            $response = $this->client->post('/api/pdf/generate-by-url', [
                'form_params' => [
                    'url' => $url,
                    'filename' => $filename,
                ],
            ]);

            return json_decode($response->getBody()->getContents())->download_url;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
