<?php

namespace App\Console\Commands;

use App\Models\Business;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateBusinessSlots extends Command
{

    protected $signature = 'app:generate-business-slots';


    protected $description = 'Generate business slots for days';

    /**
     * Execute the console command.
     */
    public function handle()
    {


        $businesses = Business::with('slots', 'schedules')->get();

        foreach ($businesses as $business) {

            if (! $business->slots()->count()) {
                $this->generateInitialSlotsForBusiness($business);

                continue;
            }


            //Si el negocio tiene slots, miro si el último slot creado es más antiguo que los max_future_days

            $lastSlot = $business->slots->sortByDesc('slot_date')->first();
            $endDate = now()->addDays($business->max_future_days);

            if ($lastSlot->slot_date->lt($endDate)) {
                $this->generateNewSlotsForBusiness($business, $lastSlot->slot_date, $endDate);
            }
        }
    }



    private function generateInitialSlotsForBusiness(Business $business): void
    {

        $startDate = now();
        $endDate = now()->addDays($business->max_future_days);

        while ($startDate->lt($endDate)) {
            $this->createSlots($startDate, $business);
        }
    }




    private function generateNewSlotsForBusiness(Business $business, Carbon $slotDate, Carbon $endDate): void
    {
        $startDate = $slotDate->addDay();

        while ($startDate->lt($endDate)) {
            $this->createSlots($startDate, $business);
        }
    }



    private function createSlots(Carbon $startDate, Business $business): void
    {
        if ($business->slots->where('slot_date', $startDate->toDateString())->count()) {
            return;
        }


        $dayOfWeek = $startDate->dayOfWeek;
        $schedule = $business->schedules
            ->where('day_of_week', $dayOfWeek)
            ->where('is_closed', false)
            ->first();

        if ($schedule) {

            $openTime = now()->setTimeFromTimeString($schedule->open_time);
            $closeTime = now()->setTimeFromTimeString($schedule->close_time);
            $slots = collect();


            while ($openTime->lt($closeTime)) {

                $slots->push([

                    'slot_date' => $startDate->toDateString(),
                    'start_time' => $openTime->copy()->toTimeString(),
                    'end_time' => $openTime->copy()->addMinutes($business->slot_duration)->toTimeString(),
                ]);


                $openTime->addMinutes($business->slot_duration);
            }


            $business->slots()->createMany($slots->toArray());
        }


        $startDate->addDay();
    }
}
