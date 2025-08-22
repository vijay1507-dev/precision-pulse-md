<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class DoctorScheduleController extends Controller
{
    /**
     * Return available booking dates for a doctor
     */
    public function availableDates(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|integer|exists:doctors,id',
        ]);

        $doctor = $this->getDoctorWithAvailability($validated['doctor_id']);

        if (!$this->isDoctorAvailable($doctor)) {
            return $this->errorResponse('Doctor is not available for booking.', [
                'doctor_id'       => $doctor->id,
                'available_dates' => [],
                'available_days'  => [],
            ]);
        }

        $availability = $doctor->availability;

        return $this->successResponse('Doctor is available for booking.', [
            'doctor_id'       => $doctor->id,
            'available_dates' => $this->calculateAvailableDates($doctor),
            'available_days'  => $this->parseAvailableDays($availability->available_days),
        ]);
    }

    /**
     * Return time slots for a doctor on a given date
     */
    public function availableSlots(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date'      => 'required|date',
        ]);

        $doctor = $this->getDoctorWithAvailability($validated['doctor_id']);

        if (!$this->isDoctorAvailable($doctor)) {
            return $this->errorResponse('Doctor is not available for booking.');
        }

        return $this->successResponse('Available slots fetched successfully', [
            'date'  => $validated['date'],
            'slots' => $this->generateAvailableTimeSlots($doctor, $validated['date']),
        ]);
    }

    /**
     * Fetch doctor with availability
     */
    private function getDoctorWithAvailability($id)
    {
        return Doctor::with('availability', 'appointments')->find($id);
    }

    /**
     * Check if doctor is currently available for bookings
     */
    private function isDoctorAvailable($doctor): bool
    {
        return $doctor && $doctor->availability && $doctor->availability->is_available;
    }

    /**
     * Calculate dates a doctor is available, excluding blocked
     */
    private function calculateAvailableDates($doctor): array
    {
        $availability    = $doctor->availability;
        $availableDays   = $this->parseAvailableDays($availability->available_days);
        $blockedDates    = $this->parseBlockedDates($availability->blocked_dates) ?? [];

        $from = $this->resolveStartDate($availability->available_from);
        $to   = $this->resolveEndDate($availability->available_to);

        $period = CarbonPeriod::create($from, $to);

        return $this->filterAvailableDates($period, $availableDays, $blockedDates);
    }

    /**
     * Create time slots for a doctor on a given date
     */
    private function generateAvailableTimeSlots($doctor, string $date): array
    {
        $availability = $doctor->availability;
        $weekday = Carbon::parse($date)->format('l');

        if (!collect($availability->available_days)->contains($weekday)) {
            return [];
        }

        $start = Carbon::parse("{$date} {$availability->start_time}");
        $end   = Carbon::parse("{$date} {$availability->end_time}");
        $step  = $availability->slot_duration;
        $slots = [];

        $bookedTimes = $doctor->appointments()
            ->whereDate('appointment_date', $date)
            ->pluck('appointment_time')
            ->map(fn($t) => Carbon::parse("{$date} {$t}")->format('H:i'))
            ->toArray();

        while ($start->lt($end)) {
            $slot = $start->format('H:i');

            if (!in_array($slot, $bookedTimes)) {
                $slots[] = $slot;
            }

            $start->addMinutes($step);
        }

        return $slots;
    }

    /**
     * Normalize available days array
     */
    private function parseAvailableDays($days): Collection
    {
        return collect(is_array($days) ? $days : []);
    }

    /**
     * Normalize blocked_dates into clean array
     */
    private function parseBlockedDates($blocked): ?array
    {
        $dates = is_array($blocked)
            ? array_filter(array_map('trim', $blocked))
            : array_filter(array_map('trim', explode(',', $blocked ?? '')));

        return empty($dates) ? null : $dates;
    }

    /**
     * Fallback start date = today
     */
    private function resolveStartDate($from): Carbon
    {
        return $from ? Carbon::parse($from) : Carbon::today();
    }

    /**
     * Fallback end date = today + 30
     */
    private function resolveEndDate($to): Carbon
    {
        return $to ? Carbon::parse($to) : Carbon::today()->addDays(30);
    }

    /**
     * Filter available days excluding blocked ones
     */
    private function filterAvailableDates(CarbonPeriod $period, Collection $availableDays, array $blockedDates): array
    {
        $normalizedBlocked = collect($blockedDates)
            ->map(fn($d) => trim($d))
            ->filter()
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->toArray();

        return collect($period)
            ->filter(fn($date) =>
                $availableDays->contains($date->format('l')) &&
                !in_array($date->toDateString(), $normalizedBlocked)
            )
            ->map(fn($date) => $date->toDateString())
            ->values()
            ->toArray();
    }

    /**
     * Standard API success response
     */
    private function successResponse(string $message, array $data = [], int $status = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], $status);
    }

    /**
     * Standard API error response
     */
    private function errorResponse(string $message, array $errors = [], int $status = 422)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors
        ], $status);
    }
}
