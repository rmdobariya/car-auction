<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuctionStatusUpdate extends Command
{

    protected $signature = 'auction_status_update';

    protected $description = 'Command set auction Status Update';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $vehicles = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', 'vehicle_translations.vehicle_id')
            ->leftJoin('vehicle_categories', 'vehicles.vehicle_category_id', 'vehicle_categories.id')
            ->whereNull('vehicles.deleted_at')
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.is_vehicle_type', 'car_for_auction')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.is_auction_awarded', 0)
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->get();
        foreach ($vehicles as $vehicle) {
            $startDateTime = Carbon::parse($vehicle->auction_start_date . ' ' . $vehicle->auction_start_time);
            $endDateTime = Carbon::parse($vehicle->auction_end_date . ' ' . $vehicle->auction_end_time);
            $currentDateTime = Carbon::now();

            // Check if current time is within the auction time range
            if ($currentDateTime->between($startDateTime, $endDateTime)) {
//                DB::table('vehicles')->where('id', $vehicle->id)->update([
//                    'status' => 'ongoing'
//                ]);
            } else {
                // If the auction is in the future, set status to "pending"
                if ($vehicle->status === 'pending' && $vehicle->auction_start_date > date('Y-m-d')) {
                    DB::table('vehicles')->where('id', $vehicle->id)->update([
                        'status' => 'pending'
                    ]);
                } // Check if the auction is "pending" and the date/time has expired
                elseif ($vehicle->status === 'approve' && $currentDateTime->greaterThan($endDateTime)) {
                    DB::table('vehicles')->where('id', $vehicle->id)->update([
                        'status' => 'auction_close'
                    ]);
                }
//                elseif ($vehicle->status === 'auction_close' && $currentDateTime->lessThan($endDateTime)) {
//                    DB::table('vehicles')->where('id', $vehicle->id)->update([
//                        'status' => 'approve'
//                    ]);
//                }
            }
        }
    }
}
