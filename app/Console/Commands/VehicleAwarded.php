<?php

namespace App\Console\Commands;

use App\Mail\Web\VehicleAwardedEmail;
use App\Mail\Web\VehicleBuyerEmail;
use App\Mail\Web\VehicleSellerEmail;
use App\Models\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehicleAwarded extends Command
{

    protected $signature = 'vehicle_awarded';

    protected $description = 'Command set auction start time';


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
            ->orderBy('vehicles.id', 'desc')
            ->select('vehicles.*', 'vehicle_translations.name as vehicle_name', 'vehicle_categories.name as category_name')
            ->get();
        foreach ($vehicles as $vehicle) {
//            DB::table('auction_horses')->where('id', $vehicle->id)->update([
//                'is_auction_awarded' => 1
//            ]);
            $bids = DB::table('vehicle_bids')->where('vehicle_id', $vehicle->id)
                ->where('is_winner', 1)->first();

            if (!is_null($bids)) {
                $user = DB::table('users')->where('id', $bids->user_id)->first();

                $array = [
                    'user_name' => $user->name,
                    'subject' => "Car Awarded To You",
                    'message' => 'Car' . ' ' . ($vehicle->vehicle_name) . ' ' . 'Awarded To You',
                ];
                $buyer_mail_array = [
                    'user_name' => $user->name,
                    'subject' => "Zodha <> sold",
                    'message' => 'Thank you for using Zodha.This is confirm that you have purchased' . ' ' . ($vehicle->vehicle_name) . ' ' . 'through our auction' . ' ' . ($vehicle->vehicle_name) . ' ' . Carbon::parse($bids->created_at)->format('Y-m-d/g:i A') . ' ' . 'for an amount of' . ' ' . $bids->amount . ' ' . 'SAR',
                ];
                $seller_user = DB::table('users')->where('id', $vehicle->user_id)->first();
                $seller_mail_array = [
                    'user_name' => $seller_user->name,
                    'subject' => "Zodha <> sold",
                    'message' => 'Thank you for using Zodha.This is confirm that you your Vehicle' . ' ' . ($vehicle->vehicle_name) . ' ' . 'hse been sold through our auction' . ' ' . ($buyer_mail_array['user_name']) . ' ' . Carbon::parse($bids->created_at)->format('Y-m-d/g:i A') . ' ' . 'for an amount of' . ' ' . $bids->amount . ' ' . 'SAR',
                ];
                if ($vehicle->is_auction_awarded === 0) {
                    if ($vehicle->auction_end_date < date('Y-m-d')) {
                        Mail::to($user->email)->send(new VehicleAwardedEmail($array));
                        Mail::to($user->email)->send(new vehicleBuyerEmail($buyer_mail_array));
                        Mail::to($seller_user->email)->send(new VehicleSellerEmail($seller_mail_array));
                        $user_notification = new  Notification();
                        $user_notification->user_id = $user->id;
                        $user_notification->vehicle_id = $vehicle->id;
                        $user_notification->message = 'Auction Awarded';
                        $user_notification->type = 'auction_awarded';
                        $user_notification->save();
                        DB::table('vehicles')->where('id', $vehicle->id)->update([
                            'is_auction_awarded' => 1
                        ]);
                    }
                }
            }
        }
    }
}
