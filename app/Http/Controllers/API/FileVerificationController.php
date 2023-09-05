<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Traits\HashTrait;
use App\Traits\TransformTrait;
use App\Traits\VerifyTrait;
use App\Http\Resources\VerifiableFileResource;
use App\Models\VerifiableAnalysis;

class FileVerificationController extends Controller
{
    use HashTrait, TransformTrait, VerifyTrait;

    public function verifyFile(FileRequest $request)
    {
        $validated        = $request->validated();
        $requestData      = $validated['data'];
        $fileID           = $requestData['id'];

        $requestSignature = $validated['signature'];

        $issuerName       = "";
        $result           = $this->verifyRecipient($requestData['recipient']);

        if (!$result) {

            $result       = $this->verifyIssuer($requestData['issuer']);

            if (!$result) {

                $issuerName    = $this->getIssuerName($requestData['issuer']);
                $transformData = $this->flattenArrayKeys($requestData);
                $hashedData    = $this->hashTransformData($transformData);
                $result        = $this->verifySignature($hashedData, $requestSignature);

                $this->saveVerifyResult($fileID,$issuerName,$result);
            }
        }

        return new VerifiableFileResource($issuerName, $result);
    }

    public function getIssuerName($issuer)
    {
        if (isset($issuer) && is_array($issuer)) {
            return $issuer['name'];
        } else {
            return "";
        }
    }

    public function saveVerifyResult($fileID,$issuerName,$result)
    {
        VerifiableAnalysis::CREATE([
            'user_id'   => auth()->user()->id,
            'file_id'   => $fileID,
            'file_type' => 'json',
            'result'    => json_encode([$issuerName,$result])
        ]);

        return 1;
    }
}
