<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class VehicleResource extends JsonResource
{
    public function toArray($request)
    {
        $vehicle_image = DB::table('vehicle_images')->where('vehicle_id', $this->id)->get();
        $vehicle_document = DB::table('vehicle_documents')->where('vehicle_id', $this->id)->get();
        $bid_count = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->count();
        $my_bid_amount = 0;
        $is_wishlist = 0;
        $p_bid_count = 0;
        $payment_status = '';
        if(!is_null($request->login_user_id)){
            $p_bid_count = DB::table('vehicle_bids')->where('user_id',$request->login_user_id)->count();
            $proof_check = DB::table('payment_proofs')->where('user_id',$request->login_user_id)->first();
            if(!is_null($proof_check)){
                $payment_status = $proof_check->status;
            }
        }
        $height_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->max('amount');
        if (!is_null($request->user_id)) {
            $wishlist = DB::table('wish_lists')->where('vehicle_id', $this->id)->where('user_id', $request->user_id)->first();
            if (!is_null($wishlist)) {
                $is_wishlist = 1;
            } else {
                $is_wishlist = 0;
            }
            $my_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->where('user_id', $request->user_id)->orderBy('id', 'desc')->first();
            if (!is_null($my_bid)){
                $my_bid_amount = $my_bid->amount;
            }else{
                $my_bid_amount = 0;
            }
            $height_bid = DB::table('vehicle_bids')->where('vehicle_id', $this->id)->where('user_id', $request->user_id)->max('amount');
        }
        if ($this->car_report) {
            $car_report = 'https://car-auction.projectdemo.click/' . $this->car_report;
        } else {
            $car_report = '';
        }
        if (!is_null($this->auction_end_date)) {
            $current_date = Carbon::now();
            if ($this->auction_end_date > $current_date) {
                $end_date = Carbon::createFromFormat('Y-m-d', $this->auction_end_date)->endOfDay();
                $diff = $current_date->diff($end_date);
                $days = $diff->days;
                $hours = $diff->h;
                $minute = $diff->i;
                $second = $diff->s;
            } else {
                $days = 0;
                $hours = 0;
                $minute = 0;
                $second = 0;
            }
        } else {
            $days = 0;
            $hours = 0;
            $minute = 0;
            $second = 0;
        }

        return [
            'id' => $this->id,
            'name' => $this->vehicle_name,
            'user_id' => $this->user_id,
            'vehicle_category_name' => $this->vehicle_category_name,
            'year' => $this->year == null ? '' : $this->year,
            'make' => $this->make == null ? '' : $this->make,
            'model' => $this->model == null ? '' : $this->model,
            'trim' => $this->trim == null ? '' : $this->trim,
            'kms_driven' => $this->kms_driven == null ? '' : $this->kms_driven,
            'owners' => $this->owners == null ? '' : $this->owners,
            'transmission' => $this->transmission == null ? '' : $this->transmission,
            'fuel_type' => $this->fuel_type == null ? '' : $this->fuel_type,
            'body_type' => $this->body_type == null ? '' : $this->body_type,
            'registration' => $this->registration == null ? '' : $this->registration,
            'color' => $this->color == null ? '' : $this->color,
            'mileage' => $this->mileage == null ? '' : $this->mileage,
            'car_type' => $this->car_type == null ? '' : $this->car_type,
            'price' => $this->price == null ? '' : $this->price,
            'bid_increment' => $this->bid_increment == null ? '' : $this->bid_increment,
            'ratting' => $this->ratting == null ? '' : $this->ratting,
            'is_product' => $this->is_product == null ? '' : $this->is_product,
            'is_vehicle_type' => $this->is_vehicle_type == null ? '' : $this->is_vehicle_type,
            'main_image' => 'https://car-auction.projectdemo.click/' . $this->main_image,
            'file_name' => pathinfo($this->main_image, PATHINFO_BASENAME),
            'car_report' => $car_report,
            'car_report_file_name' => pathinfo($this->car_report, PATHINFO_BASENAME),
            'status' => $this->status == null ? '' : $this->status,
            'auction_start_date' => $this->auction_start_date == null ? '' : $this->auction_start_date,
            'auction_end_date' => $this->auction_end_date == null ? '' : $this->auction_end_date,
            'auction_start_time' => $this->auction_start_time == null ? '' : $this->auction_start_time,
            'auction_end_time' => $this->auction_end_time == null ? '' : $this->auction_end_time,
//            'short_description' => $this->short_description,
            'description' => $this->description == null ? '' : $this->description,
            'people_are_interested' => $bid_count,
            'my_bid_amount' => $my_bid_amount,
            'height_bid' => !is_null($height_bid) ? $height_bid : 0,
            'day' => $days,
            'hours' => $hours,
            'minute' => $minute,
            'second' => $second,
            'is_wishlist' => $is_wishlist,
            'p_bid_count' => $p_bid_count,
//            'proof_check' => $proof_check,
            'payment_status' => $payment_status,
            'other_image' => VehicleImageResource::collection($vehicle_image),
            'vehicle_documents' => VehicleDocumentResource::collection($vehicle_document)
        ];
    }
}
