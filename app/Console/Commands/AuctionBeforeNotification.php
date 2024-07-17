<?php

namespace App\Console\Commands;

use App\Mail\Web\VehicleAwardedEmail;
use App\Mail\Web\VehicleBuyerEmail;
use App\Mail\Web\VehicleSellerEmail;
use App\Models\Notification;
use App\Models\Vehicle;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuctionBeforeNotification extends Command
{

    protected $signature = 'auction_before_notification';

    protected $description = 'Command set auction before notification';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $currentDateTime = Carbon::now();

        $auctions = DB::table('vehicles')
            ->leftJoin('vehicle_translations', 'vehicles.id', '=', 'vehicle_translations.vehicle_id')
            ->where('vehicles.auction_start_date', '<=', $currentDateTime->toDateString()) // Check if current date is between start date and end date
            ->where('vehicles.auction_end_date', '>=', $currentDateTime->toDateString())
            ->where(function ($query) use ($currentDateTime) {
                $query->whereRaw("TIMESTAMPDIFF(HOUR, '{$currentDateTime->toDateTimeString()}', vehicles.auction_end_time) >= 6");
            })
            ->where('vehicle_translations.locale', App::getLocale())
            ->where('vehicles.is_vehicle_type', '==', 'car_for_auction')
            ->where('vehicles.status', 'approve')
            ->where('vehicles.status', '!=', 'auction_close')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name')
            ->get();

        foreach ($auctions as $auction) {
            $user = DB::table('users')->where('id', $auction->user_id)->first();
            // Send notification email
            DB::table('notifications')->insert([
                'user_id' => $user->id,
                'first_name' => $user->name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'mobile_no' => $user->mobile_no,
                'type' => 'auction_about_to_expire',
                'created_at' => Carbon::now(),
                'message' => $auction->vehicle_name . ' ' . 'is about to expire',
            ]);
        }
    }
}
