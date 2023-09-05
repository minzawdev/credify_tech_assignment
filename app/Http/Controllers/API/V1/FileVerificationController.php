<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Traits\HashTrait;
use App\Traits\TransformTrait;
use App\Traits\VerifyTrait;
use App\Models\VerifiableAnalysis;
use App\Http\Resources\VerifiableFileResource;
use App\Http\Resources\FileAnalysisResource;

class FileVerificationController extends Controller
{
    use HashTrait, TransformTrait, VerifyTrait;

    public function verifyFile(FileRequest $request)
    {
        $validated        = $request->validated();
        $requestData      = $validated['data'];
        $requestSignature = $validated['signature'];

        $issuerName       = "";
        $result           = $this->verifyRecipient($requestData['recipient']);

        if (!$result) {

            $result       = $this->verifyIssuer($requestData['issuer']);

            if (!$result) {

                $issuerName    = $this->issuerName($requestData['issuer']);
                $transformData = $this->flattenArrayKeys($requestData);
                $hashedData    = $this->hashTransformData($transformData);
                $result        = $this->verifySignature($hashedData, $requestSignature);
            }
        }

        VerifiableAnalysis::CREATE([
            'user_id'   => auth()->user()->id,
            'file_id'   => $requestData['id'],
            'file_type' => 'json',
            'verification_result' => ['issuer' => $issuerName, 'result' => $result]
        ]);

        return new VerifiableFileResource($issuerName, $result);
    }

    public function getAnalysisFile()
    {
        $analysisFiles = VerifiableAnalysis::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return FileAnalysisResource::collection($analysisFiles);
    }
}
