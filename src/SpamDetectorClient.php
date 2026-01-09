<?php

declare(strict_types=1);

namespace SharpAPI\ContentSpam;

use GuzzleHttp\Exception\GuzzleException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * Detect spam content using AI - identifies spam with confidence score
 *
 * @package SharpAPI\ContentSpam
 * @api
 */
class SpamDetectorClient extends SharpApiClient
{
    public function __construct(
        string $apiKey,
        ?string $apiBaseUrl = 'https://sharpapi.com/api/v1',
        ?string $userAgent = 'SharpAPIPHPContentSpam/1.0.0'
    ) {
        parent::__construct($apiKey, $apiBaseUrl, $userAgent);
    }

    /**
     * Detect spam content using AI - identifies spam with confidence score
     *
     * @param string $content The text content to process
     * @return string Status URL for polling the job result
     * @throws GuzzleException
     * @api
     */
    public function detectSpam(
        string $content
    ): string {
        $response = $this->makeRequest('POST', '/content/detect_spam', array_filter([
            'content' => $content
        ], fn($v) => $v !== null));

        return $this->parseStatusUrl($response);
    }
}
