<?php

namespace Tests\Integration;

use Revolution\Google\SearchConsole\Facades\SearchConsole;
use Tests\TestCase;

class ServiceAccountTest extends TestCase
{
    public function test_list_sites()
    {
        // Check if service account credentials are available
        $serviceAccountJson = env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION');

        if (empty($serviceAccountJson)) {
            $this->markTestSkipped('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION environment variable not set');
        }

        // Validate that the JSON contains proper service account structure
        if (is_string($serviceAccountJson) && (str_starts_with($serviceAccountJson, '{') || str_starts_with($serviceAccountJson, '['))) {
            $credentials = json_decode($serviceAccountJson, true);
            if (json_last_error() !== JSON_ERROR_NONE || ! isset($credentials['client_email'])) {
                $this->markTestSkipped('Invalid service account JSON structure in GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION');
            }
        } elseif (file_exists($serviceAccountJson)) {
            // Validate the JSON file content
            $fileContent = file_get_contents($serviceAccountJson);
            $credentials = json_decode($fileContent, true);
            if (json_last_error() !== JSON_ERROR_NONE || ! isset($credentials['client_email'])) {
                $this->markTestSkipped('Invalid service account JSON structure in file: '.$serviceAccountJson);
            }
        } else {
            $this->markTestSkipped('Service account JSON file not found: '.$serviceAccountJson);
        }

        try {
            $sites = SearchConsole::listSites();
            $this->assertNotNull($sites);

            // Additional assertions to verify the response structure
            $this->assertIsObject($sites);

            // If sites are returned, verify they have expected structure
            if (isset($sites->siteEntry) && is_array($sites->siteEntry)) {
                foreach ($sites->siteEntry as $site) {
                    $this->assertObjectHasProperty('siteUrl', $site);
                    $this->assertObjectHasProperty('permissionLevel', $site);
                }
            }

        } catch (\Exception $e) {
            // If authentication fails, provide helpful error message
            if (str_contains($e->getMessage(), 'authentication') ||
                str_contains($e->getMessage(), 'forbidden') ||
                str_contains($e->getMessage(), 'unauthorized')) {
                $this->fail('Service account authentication failed. Ensure the service account email is added to Search Console properties with proper permissions: '.$e->getMessage());
            }

            // Handle invalid service account credentials
            if (str_contains($e->getMessage(), 'OpenSSL unable to validate key') ||
                str_contains($e->getMessage(), 'Invalid key or passphrase')) {
                $this->fail('Invalid service account private key. Please check the GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION contains valid service account credentials: '.$e->getMessage());
            }

            // Re-throw other exceptions
            throw $e;
        }
    }
}
