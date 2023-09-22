<?php

namespace App\Helpers;


class AdminDataTableButtonHelper
{
    public static function actionButtonDropdown($array): string
    {
        $action_button_dropdown = '<a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">';
        $action_button_dropdown .= 'Actions';
        $action_button_dropdown .= '<span class="svg-icon svg-icon-5 m-0">';
        $action_button_dropdown .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
</svg>';
        $action_button_dropdown .= '</span>';
        $action_button_dropdown .= '</a>';
        $action_button_dropdown .= '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">';
        foreach ($array['actions'] as $key => $value) {
            if ((string)$key === 'edit') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="' . $value . '" class="menu-link px-3">Edit</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'detail-page') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="' . $value . '" class="menu-link px-3">Detail</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'delete') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="menu-link px-3 delete-single">Delete</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'hard-delete') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="menu-link px-3 hard-delete-single">Hard Delete</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'restore') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="menu-link px-3 restore">Restore</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'status' && (string)$value === 'active') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)"  data-status="inActive" data-id="' . $array['id'] . '" class="menu-link px-3 status-change">Inactive</a>';
                $action_button_dropdown .= '</div>';
            } else if ((string)$key === 'status' && (string)$value === 'inActive') {
                $action_button_dropdown .= '<div class="menu-item px-3">';
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="active" data-id="' . $array['id'] . '" class="menu-link px-3 status-change">Active</a>';
                $action_button_dropdown .= '</div>';
            }
        }
        $action_button_dropdown .= ' </div>';

        return $action_button_dropdown;
    }

    public static function statusBadge($array): string
    {
        if ((string)$array['status'] === 'active') {
            return '<div class="badge badge-light-success">Active</div>';
        } else {
            return '<div class="badge badge-light-danger">Inactive</div>';
        }
    }
}
