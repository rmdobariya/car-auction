<?php

namespace App\Helpers;


class AdminDataTableButtonHelper
{
    public static function actionButtonDropdown($array): string
    {
        $action_button_dropdown = '<a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">';
        $action_button_dropdown .= trans('admin_string.actions');
        $action_button_dropdown .= '<span class="svg-icon svg-icon-5 m-0">';
        $action_button_dropdown .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
</svg>';
        $action_button_dropdown .= '</span>';
        $action_button_dropdown .= '</a>';
        $action_button_dropdown .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">';
        foreach ($array['actions'] as $key => $value) {
            if ((string)$key === 'edit' && $array['actions']['edit_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="' . $value . '" class="menu-link px-3">' . trans('admin_string.edit') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'add_vehicle') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="' . $value . '" class="menu-link px-3">' . trans('admin_string.add_vehicle') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'detail-page' && $array['actions']['detail_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="' . $value . '" class="menu-link px-3">' . trans('admin_string.details') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'delete' && $array['actions']['delete_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="menu-link px-3 delete-single">' . trans('admin_string.delete') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'hard-delete' && $array['actions']['delete_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="menu-link px-3 hard-delete-single">' . trans('admin_string.hard_delete') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'restore' && $array['actions']['restore_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="menu-link px-3 restore">' . trans('admin_string.restore') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'status' && (string)$value === 'active' && $array['actions']['status_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"  data-status="inActive" data-id="' . $array['id'] . '" class="menu-link px-3 status-change">' . trans('admin_string.inactive') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'status' && (string)$value === 'inActive' && $array['actions']['status_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="active" data-id="' . $array['id'] . '" class="menu-link px-3 status-change">' . trans('admin_string.active') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'vehicle-status' && (string)$value === 'pending' && $array['actions']['status_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="approve" data-id="' . $array['id'] . '" class="menu-link px-3 status-change">' . trans('admin_string.approve') . '</a>';
                $action_button_dropdown .= '</div>';
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="reject" data-id="' . $array['id'] . '" class="menu-link px-3 status-change">' . trans('admin_string.reject') . '</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'vehicle-status' && (string)$value === 'approve' && $array['actions']['status_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="reject" data-id="' . $array['id'] . '" class="menu-link px-3 status-change">' . trans('admin_string.reject') . '</a>';
                $action_button_dropdown .= '</div>';
            }else if ((string)$key === 'payment-status' && (string)$value === 'approved' && $array['actions']['status_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="reject" data-id="' . $array['id'] . '" class="menu-link px-3 payment-status-change">' . trans('admin_string.reject') . '</a>';
                $action_button_dropdown .= '</div>';
            }else if ((string)$key === 'payment-status' && (string)$value === 'pending' && $array['actions']['status_permission'] == true) {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="approved" data-id="' . $array['id'] . '" class="menu-link px-3 payment-status-change">' . trans('admin_string.approve') . '</a>';
                $action_button_dropdown .= '</div>';
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="reject" data-id="' . $array['id'] . '" class="menu-link px-3 payment-status-change">' . trans('admin_string.reject') . '</a>';
                $action_button_dropdown .= '</div>';
            }
        }
        $action_button_dropdown .= ' </div>';

        return $action_button_dropdown;
    }

    public static function statusBadge($array): string
    {
        if ((string)$array['status'] === 'active') {
            return '<div class="badge badge-light-success">' . trans('admin_string.active') . '</div>';
        } else {
            return '<div class="badge badge-light-danger">' . trans('admin_string.inactive') . '</div>';
        }
    }
 public static function paymentStatusBadge($array): string
    {
        if ((string)$array['status'] === 'pending') {
            return '<div class="badge badge-light-warning">' . trans('admin_string.pending') . '</div>';
        } elseif((string)$array['status'] === 'approved') {
            return '<div class="badge badge-light-success">' . trans('admin_string.approved') . '</div>';
        }else{
            return '<div class="badge badge-light-danger">' . trans('admin_string.reject') . '</div>';
        }
    }

    public static function vehicleStatusBadge($array): string
    {
        if ((string)$array['status'] === 'pending') {
            return '<div class="badge badge-light-warning">' . trans('admin_string.pending') . '</div>';
        } elseif ((string)$array['status'] === 'approve') {
            return '<div class="badge badge-light-success">' . trans('admin_string.approve') . '</div>';
        } elseif ((string)$array['status'] === 'reject') {
            return '<div class="badge badge-light-danger">' . trans('admin_string.reject') . '</div>';
        } elseif ((string)$array['status'] === 'auction_close') {
            return '<div class="badge badge-light-danger">' . trans('admin_string.auction_close') . '</div>';
        } elseif ((string)$array['status'] === 'ongoing') {
            return '<div class="badge badge-light-danger">' . trans('admin_string.ongoing') . '</div>';
        }
    }
}
