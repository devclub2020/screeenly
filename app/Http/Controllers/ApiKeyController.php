<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApiKeyRequest;
use App\Http\Requests\DeleteApiKeyRequest;
use App\Models\ApiKey;

class ApiKeyController extends Controller
{
    /**
     * @var App\Models\ApiKey
     */
    protected $apiKey;

    public function __construct(ApiKey $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Store ApiKey to Storage
     * @param  CreateApiKeyRequest $request
     * @return Redirect
     */
    public function store(CreateApiKeyRequest $request)
    {
        $this->apiKey->create([
            'name' => $request->get('name'),
            'key' => $this->apiKey->generateKey(),
            'user_id' => auth()->id()
        ]);

        return redirect()->back()->withMessage("Your new API Key has been created.");
    }

    /**
     * Delete ApiKey from Storage
     * @param  DeleteApiKeyRequest $request
     * @param  ApiKey              $apiKey
     * @return Redirect
     */
    public function destroy(DeleteApiKeyRequest $request, ApiKey $apiKey)
    {
        $apiKey->delete();

        return redirect()->back()->withMessage("API Key destroyed.");
    }
}
