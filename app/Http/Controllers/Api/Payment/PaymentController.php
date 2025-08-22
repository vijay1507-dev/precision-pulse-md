<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request): JsonResponse
    {
       // $user = $request->user();
        $amount = $this->calculateAmount($request->amount);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $intent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                //'metadata' => ['user_id' => $user->id],
            ]);

            return $this->successResponse(['client_secret' => $intent->client_secret]);

        } catch (\Exception $e) {
            return $this->errorResponse('Stripe error', $e->getMessage(), 400);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'payment_intent_id' => 'required|string',
            'appointment_id'    => 'required|exists:appointments,id',
        ]);

        $user = $request->user();
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $intent = PaymentIntent::retrieve($data['payment_intent_id']);
            $paymentData = $this->extractPaymentData($intent, $user->id, $data['appointment_id']);

            $payment = Payment::create($paymentData);

            return $this->successResponse([
                'message' => 'Payment saved successfully.',
                'payment' => $payment,
            ]);

        } catch (\Exception $e) {
            Log::error('Stripe PaymentIntent error: ' . $e->getMessage());

            Payment::create($this->createFailedPaymentData($user->id, $data['appointment_id'], $data['payment_intent_id'], $e->getMessage()));

            return $this->errorResponse('Failed to store payment.', $e->getMessage(), 500);
        }
    }

    // ─── PRIVATE HELPERS ─────────────────────────────────────

    private function calculateAmount($amount): int
    {
        return is_numeric($amount) && $amount > 0
            ? (int) ($amount * 100)
            : 5000; // Default $50
    }

    private function extractPaymentData($intent, $userId, $appointmentId): array
    {
        $charges = $intent->charges->data[0] ?? null;
        return [
            'user_id'             => $userId,
            'appointment_id'      => $appointmentId,
            'gateway'             => 'stripe',
            'status'              => $intent->status === 'succeeded' ? 'paid' : 'failed',
            'transaction_id'      => $intent->id,
            'gateway_reference'   => $charges['id'] ?? null,
            'payment_method_type' => $charges['payment_method_details']['type'] ?? null,
            'receipt_url'         => $charges['receipt_url'] ?? null,
            'currency'            => $intent->currency,
            'amount'              => $intent->amount,
            'meta'                => $intent->toArray(),
        ];
    }

    private function createFailedPaymentData($userId, $appointmentId, $intentId, $error): array
    {
        return [
            'user_id'        => $userId,
            'appointment_id' => $appointmentId,
            'gateway'        => 'stripe',
            'status'         => 'failed',
            'transaction_id' => $intentId,
            'amount'         => 0,
            'meta'           => ['error' => $error],
        ];
    }

    private function successResponse(array $data, int $code = 200): JsonResponse
    {
        return response()->json(['success' => true] + $data, $code);
    }

    private function errorResponse(string $message, $error, int $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error'   => $error,
        ], $code);
    }
}
