<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnquireForm;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreEnquiryFormRequest;
class EnquireFormController extends Controller
{
    public function store(StoreEnquiryFormRequest $request): JsonResponse
    {
        EnquireForm::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your enquiry! We’ll be in touch shortly.',
        ]);
    }
}