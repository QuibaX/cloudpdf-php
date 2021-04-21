<?php

namespace QuibaX\CloudPdf;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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
    public function fromHtml(string $html, string $filename, float $width = null, float $height = null, string $unit = 'mm', bool $direct = false)
    {
        $response = $this->client->post('/api/pdf/generate', [
            RequestOptions::JSON =>  [
                'html' => $html,
                'filename' => $filename,
                'direct' => $direct,
                'width' => $width,
                'height' => $height,
                'unit' => $unit
            ]
        ]);

        if($direct)
            return $response->getBody()->getContents();
        else
            return json_decode($response->getBody()->getContents())->download_url;
    }

    /**
     * @param $url string A publicly accessible url to be converted into pdf.
     * @param $filename string The file will be downloaded with this given name
     * @return string|bool Return's the download url. Return's false on error.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fromUrl(string $url, string $filename)
    {
        $response = $this->client->post('/api/pdf/generate-by-url', [
            'form_params' => [
                'url' => $url,
                'filename' => $filename,
            ],
        ]);

        return json_decode($response->getBody()->getContents())->download_url;
    }
}
