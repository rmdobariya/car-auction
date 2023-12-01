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
            $startDate = Carbon::parse($vehicle->auction_start_date);
            $endDate = Carbon::parse($vehicle->auction_end_date);
            $dateToCheck = Carbon::parse(date('Y-m-d'));
            if ($dateToCheck->between($startDate, $endDate)) {
                DB::table('vehicles')->where('id', $vehicle->id)->update([
                    'status' => 'ongoing'
                ]);
            } else {
                if ($vehicle->auction_start_date > date('Y-m-d')) {
                    DB::table('vehicles')->where('id', $vehicle->id)->update([
                        'status' => 'pending'
                    ]);
                } else {
                    DB::table('vehicles')->where('id', $vehicle->id)->update([
                        'status' => 'auction_close'
                    ]);
                }
            }
        }
    }
}
