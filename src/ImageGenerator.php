<?php

namespace Valsty\CloudPdf;

use GuzzleHttp\Client;

class ImageGenerator
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
     * @param string $pdfUrl The url of the PDF to parse
     * @param string $type The return image type (png or jpg)
     * @return string|bool Return's the file
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pdfToImage(string $pdfUrl, string $type = 'jpg')
    {
        try {
            $response = $this->client->post('/api/pdf/to-image', [
                'form_params' => [
                    'pdf_url' => $pdfUrl,
                    'format' => $type,
                ],
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $exception) {
            return false;
        }
    }
}
