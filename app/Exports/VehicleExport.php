<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;


class VehicleExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $array = [];
        foreach ($this->data as $value) {
            $array[] = [
                'user_name' => $value->user_name,
                'vehicle_category' => $value->vehicle_category,
                'city' => $value->city,
                'year' => $value->year,
                'kms_driven' => $value->kms_driven,
                'owners' => $value->owners,
                'price' => $value->price,
                'bid_increment' => $value->bid_increment,
                'ratting' => $value->ratting,
                'status' => $value->status,
                'auction_start_date' => $value->auction_start_date,
                'auction_end_date' => $value->auction_end_date,
                'auction_start_time' => $value->auction_start_time,
                'auction_end_time' => $value->auction_end_time,
                'advance_payment' => $value->advance_payment,
                'advance_payment_type' => $value->advance_payment_type,
            ];
        }
        return collect($array);
    }

    public function headings(): array
    {
        return [
            trans('admin_string.user_name'),
            trans('admin_string.vehicle_category'),
            trans('admin_string.city'),
            trans('admin_string.year'),
            trans('admin_string.kms_driven'),
            trans('admin_string.owners'),
            trans('admin_string.price'),
            trans('admin_string.bid_increment'),
            trans('admin_string.ratting'),
            trans('admin_string.status'),
            trans('admin_string.auction_start_date'),
            trans('admin_string.auction_end_date'),
            trans('admin_string.auction_start_time'),
            trans('admin_string.auction_end_time'),
            trans('admin_string.advance_payment'),
            trans('admin_string.advance_payment_type'),
        ];
    }
}
