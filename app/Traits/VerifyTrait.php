<?php

namespace App\Traits;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

trait VerifyTrait
{
    public function verifyIssuer($issuer)
    {
        if (isset($issuer) && is_array($issuer)) {

            if (isset($issuer['name']) && isset($issuer['identityProof']) && is_array($issuer['identityProof'])) {

                $identityProof = $issuer['identityProof'];

                if (
                    isset($identityProof['key']) && isset($identityProof['location']) &&
                    strpos($identityProof['key'], 'did:ethr:') === 0
                ) {

                    $dns_lookup_url = 'https://dns.google/resolve?name=' . $identityProof['location'] . '&type=TXT';
                    $dns_response = json_decode(file_get_contents($dns_lookup_url), true);
                    $txt_records = array_column($dns_response['Answer'], 'data');

                    foreach ($txt_records as $record) {
                        $str = str_contains($record, $identityProof['key']);
                        if ($str) break;
                    }

                    if($str)
                        return 0;
                }
            }
        }
        
        return "invalid_issuer";
    }

    public function verifyRecipient($recipientArr)
    {

        if (isset($recipientArr['name']) && isset($recipientArr['email'])) {
            return 0;
        } else {
            return 'invalid_recipient';
        }
    }

    private function verifySignature($hashedData, $signatureData)
    {
        if ($hashedData == $signatureData['targetHash']) {
            return "verified";
        } else {
            return "invalid_signature";
        }
    }

    public function issuerName($issuer)
    {
        if (isset($issuer) && is_array($issuer)) {
            return $issuer['name'];
        } else {
            return "";
        }
    }

}
