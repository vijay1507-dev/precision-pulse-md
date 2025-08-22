<?php

namespace App\Http\Controllers\Api\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Appointment\AppointmentRequest;
use Illuminate\Http\Request;
use App\Models\Appointment\Appointment;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\Payment\PaymentController;
use Illuminate\Support\Facades\App;
use App\Models\User;
use App\Models\Doctor\Doctor;
use App\Models\IntakeForm;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Notifications\User\PatientRegisteredNotification;



class AppointmentController extends Controller
{
   public function store(AppointmentRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            // Check if request is from a logged-in user
            $user = auth()->user();

            if (!$user) {
                // Fallback to guest flow
                $user = User::where('email', $data['email'])->first();

              $profileData = [
                    'date_of_birth'   => $data['dob'],
                    'gender'          => $data['gender'],
                    'phone_number'    => $data['phone'],
                    'height_cm'       => null,
                    'height_feet'     => $data['height_feet'] ?? null,
                    'height_inches'   => $data['height_inches'] ?? null,
                    'weight_lbs'      => $data['weight_lbs'] ?? null,
                ];

                if (!$user) {
                    $pass =  Str::random(10);
                    $data['password'] = bcrypt($pass);
                    $user = User::create($data);
                    $user->assignRole('patient');

                     $user->patientProfile()->updateOrCreate(
                        ['user_id' => $user->id],
                        $profileData
                    );


                    $user->notify(new PatientRegisteredNotification($user ,$pass));
                }
            }


            if ($request->filled('follow_up_file')) {
                $data['follow_up_file'] = $this->storeBase64File(
                    $request->input('follow_up_file'),
                    'uploads/follow_up_files'
                );
            }

            if ($request->filled('schedule_file')) {
                $data['schedule_file'] = $this->storeBase64File(
                    $request->input('schedule_file'),
                    'uploads/schedule_files'
                );
            }            // Create appointment transactionally
            $appointment = DB::transaction(function () use ($user, $data) {
                return $this->createAppointment($user, $data);
            });


            // Handle payment, if applicable
            $this->handleAppointmentPayment($user, $appointment, $data);

           

            return $this->successResponse('Appointment successfully booked!',  201);

        } catch (\Throwable $e) {
            \Log::error($e); // Optional: Log the error for debugging
            return $this->errorResponse('Something went wrong.', $e);
        }
    }


    private function uploadFollowUpFile(?UploadedFile $file): ?string
    {
        return $this->storeUploadedFile($file, 'uploads/follow_up_files');
    }

    private function storeUploadedFile(?UploadedFile $file, string $path): ?string
    {
        if (!$file) {
            return null;
        }

        $this->ensureDirectoryExists($path);

        return $file->store($path, 'public');
    }

 private function storeBase64File(string $base64, string $folder = 'uploads/files'): ?string
    {
        if (!$base64 || !preg_match('/^data:(.*);base64,/', $base64, $matches)) {
            return null;
        }

        $mime = $matches[1];
        $base64 = substr($base64, strpos($base64, ',') + 1);
        $extension = explode('/', $mime)[1] ?? 'bin';

        $filename = Str::uuid() . '.' . $extension;
        $path = $folder . '/' . $filename;

        $this->ensureDirectoryExists($folder);

        Storage::disk('public')->put($path, base64_decode($base64));

        return 'storage/' . $path;
    }

    private function ensureDirectoryExists(string $path): void
    {
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }
    }


    private function createAppointment($user, array $data): Appointment
    {
        $doctor = Doctor::find($data['doctor_id']);

        if (!$doctor) {

            throw new \Exception('Doctor profile not found for this user.');
        }

        $doctorUser =  $doctor->user;
        if (!$doctorUser || !$doctorUser->hasRole('doctor')) {
            throw new \Exception('The selected user is not a valid doctor.');
        }

        return Appointment::createForDoctor( $doctor, $user, $data);
    }

    private function handleAppointmentPayment($user, Appointment $appointment, array $data): ?array
    {
        $paymentIntentId = $data['payment_info']['payment_intent_id'] ?? null;

        if (empty($paymentIntentId)) {
            return null;
        }

        $paymentController = App::make(PaymentController::class);

        $paymentRequest = new Request([
            'payment_intent_id' => $paymentIntentId,
            'appointment_id'    => $appointment->id,
        ]);
        $paymentRequest->setUserResolver(fn () => $user);

        $response = $paymentController->store($paymentRequest);
        return json_decode($response->getContent(), true);
    }

    public function getPatientAppointments(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $appointments = $this->fetchAppointmentsForUser($userId);

        return response()->json([
            'success' => true,
            'appointments' => $appointments,
        ]);
    }

    private function fetchAppointmentsForUser(int $userId)
    {
        return Appointment::with(['doctor.user'])
            ->where('user_id', $userId)
            ->orderBy('appointment_date', 'desc')
            ->get()
            ->map(fn ($appointment) => $this->transformAppointment($appointment));
    }

    private function transformAppointment(Appointment $appointment): array
    {
        $doctor = $appointment->doctor?->user;

        return [
            'id'               => $appointment->id,
            'appointment_date' => $appointment->appointment_date,
            'appointment_time' => $appointment->appointment_time,
            'scheduled_at'     => $appointment->scheduled_at,
            'status'           => $appointment->status,
            'reason'           => $appointment->reason,
            'dob'              => $appointment->dob,
            'gender'           => $appointment->gender,
            'height_feet'      => $appointment->height_feet ?? 'N/A' ,
            'height_inches'    => $appointment->height_inches ?? 'N/A',
            'phone'            => $appointment->phone,
            'doctor_name'      => $doctor ? trim("{$doctor->name} {$doctor->last_name}") : 'N/A',
            'doctor_email'     => $doctor ? trim("{$doctor->email}") : 'N/A',
            'patient_record'   => $appointment->patient_record,
            'schedule_file'    => $appointment->schedule_file ?? null,
            'follow_up_file'   => $appointment->follow_up_file?? null,

        ]; 
    }

    public function show(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        $appointment = $this->findUserAppointment($user->id, $id);

        if (!$appointment) {
            return $this->errorResponse('Appointment not found.', null, 404);
        }

        return response()->json([
            'success' => true,
            'appointment' => $this->formatAppointmentDetails($appointment),
        ]);
    }

    private function findUserAppointment(int $userId, $appointmentId): ?Appointment
    {
        return Appointment::with(['doctor.user', 'payment']) 
            ->where('user_id', $userId)
            ->where('id', $appointmentId)
            ->first();
    }


    private function formatAppointmentDetails(Appointment $appointment): array
    {
        return [
            'id'              => $appointment->id,
            'scheduled_at'    => $appointment->scheduled_at,
            'appointment_date' => $appointment->appointment_date,
            'appointment_time' =>  $appointment->appointment_time,
            'status'          => $appointment->status,
            'reason'          => $appointment->reason,
            'dob'              => $appointment->dob,
            'gender'           => $appointment->gender,
            'height_feet'      => $appointment->height_feet ?? 'N/A' ,
            'height_inches'    => $appointment->height_inches ?? 'N/A',
            'phone'            => $appointment->phone,
            'doctor_id'       => $appointment->doctor_id,
            'doctor_name' => $appointment->doctor && $appointment->doctor->user
            ? trim("{$appointment->doctor->user->name} {$appointment->doctor->user->last_name}")
            : 'N/A',
            'doctor_email'    => $appointment->doctor?->user?->email ?? null,
            'schedule_file'    => $appointment->schedule_file ?? null,
            'follow_up_file'   => $appointment->follow_up_file?? null,
            'medical_history' => $appointment->medical_history,
            'family_history'  => $appointment->family_history,
            'lifestyle'       => $appointment->lifestyle,
            'patient_record'   => $appointment->patient_record,
            'payment_info'    => $appointment->payment ? [
                'gateway'             => $appointment->payment->gateway,
                'status'              => $appointment->payment->status,
                'transaction_id'      => $appointment->payment->transaction_id,
                'gateway_reference'   => $appointment->payment->gateway_reference,
                'payment_method_type' => $appointment->payment->payment_method_type,
                'currency'            => $appointment->payment->currency,
                'amount'              => $appointment->payment->amount/100,
            ] : null,
        ];
    }

   private function successResponse(string $message, int $code = 200, array $response = []): JsonResponse
    {
        return response()->json(array_merge([
            'success' => true,
            'message' => $message,
        ], $response), $code);
    }

    private function errorResponse(string $message, ?\Throwable $e = null, int $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error'   => $e?->getMessage(),
        ], $code);
    }


    public function intakeStore(Request $request): JsonResponse
    {
        if (!$request->has('form_data')) {
        return response()->json([
                'success' => false,
                'message' => 'param form_data is missing'
            ], 422);
        }


        $request->validate([
        'form_data' => 'required|array',
        ], [
            'form_data.required' => 'form_data is required and cannot be empty',
            'form_data.array' => 'form_data must be a valid array',
        ]);

        $form = IntakeForm::updateOrCreate(
            ['user_id' => auth()->id()], 
            ['form_data' => $request->form_data]
        );

     return $this->successResponse('intake Form successfully Su

        bmitted!', 201);
    }


    public function intakeGet(): JsonResponse
    {
        $forms = auth()->user()->intakeForms()->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $forms
        ], 200);
    }


}
