<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:contact-us-read|contact-us-create|contact-us-update|contact-us-delete', ['only' => ['index']]);
        $this->middleware('permission:contact-us-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-us-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-us-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.contact-us.index');
    }

    public function getContactUsList(Request $request)
    {
        if ($request->ajax()) {
            $contact_us = DB::table('contact_us')
                ->orderBy('id', 'desc');

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $contact_us->whereNotNull('contact_us.deleted_at');
                } else {
                    $contact_us->whereNull('contact_us.deleted_at');
                }
            }
            $contact_us = $contact_us->select('contact_us.*');
            return Datatables::of($contact_us)
                ->addColumn('action', function ($contact_us) {
                    if (is_null($contact_us->deleted_at)) {
                        $array = [
                            'id' => $contact_us->id,
                            'actions' => [
                                'delete' => $contact_us->id,
                                'detail-page' => route('admin.contact-us.show', $contact_us->id),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $contact_us->id,
                            'actions' => [
                                'hard-delete' => $contact_us->id,
                                'restore' => $contact_us->id,
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('check', function ($contact_us) {
                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $contact_us->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function destroy($id): JsonResponse
    {
        ContactUs::where('id', $id)->delete();
        return response()->json([
            'message' => 'Contact Us Delete Successfully'
        ]);
    }

    public function restore($id): JsonResponse
    {
        DB::table('contact_us')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Contact Us Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('contact_us')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Contact Us Delete Successfully'
        ]);
    }

    public function multipleContactUsDelete(Request $request): JsonResponse
    {
        $contact_us = DB::table('contact_us')->whereIn('id', $request->ids)->get();
        foreach ($contact_us as $contact) {
            if (!is_null($contact->deleted_at)) {
                DB::table('contact_us')->where('id', $contact->id)->delete();
            } else {
                ContactUs::where('id', $contact->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Contact Us Delete Successfully'
        ]);
    }

    public function show($id)
    {
        $contact_us = DB::table('contact_us')->where('id', $id)->first();
        return view('admin.contact-us.show',['contact_us' => $contact_us]);
    }
}
