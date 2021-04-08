<?php

namespace QuibaX\CloudPdf;

use GuzzleHttp\Client;

class Ocr
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
     * @param string $url
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTextFromImageByUrl(string $url)
    {
        try {
            $response = $this->client->post('/api/ocr/from-image-url', [
                'form_params' => [
                    'url' => $url
                ],
            ]);

            return json_decode($response->getBody()->getContents())->contents;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param string $imageContents
     * @return false
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTextFromImage(string $imageContents)
    {
        $response = $this->client->post('/api/ocr/from-image', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => $imageContents
                ]
            ],
        ]);

        return json_decode($response->getBody()->getContents())->contents;
    }

    /**
     * @param string $url
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function getTextFromPdfByUrl(string $url)
    {
        $response = $this->client->post('/api/ocr/from-pdf-url', [
            'form_params' => [
                'url' => $url
            ],
        ]);

        return json_decode($response->getBody()->getContents())->contents;
    }

    /**
     * @param string $pdfContents
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function getTextFromPdf(string $pdfContents)
    {
        $response = $this->client->post('/api/ocr/from-pdf', [
            'multipart' => [
                [
                    'name' => 'pdf',
                    'contents' => $pdfContents,
                    'filename' => 'file.pdf'
                ]
            ],
        ]);

        return json_decode($response->getBody()->getContents())->contents;
    }
}
