<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BankStoreRequest;
use App\Http\Requests\Admin\ContactInfoStoreRequest;
use App\Http\Requests\Admin\GeneralSettingStoreRequest;
use App\Http\Requests\Admin\EmailSettingStoreRequest;
use App\Http\Requests\Admin\AppSettingStoreRequest;
use App\Http\Requests\Admin\SocialMediaStoreRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:setting-read|setting-create|setting-update|setting-delete|setting-general', ['only' => ['index']]);
        $this->middleware('permission:setting-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:setting-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:setting-delete', ['only' => ['destroy']]);
        $this->middleware('permission:setting-general', ['only' => ['generalSettingStore']]);
        $this->middleware('permission:setting-email', ['only' => ['emailSettingStore']]);
        $this->middleware('permission:setting-app', ['only' => ['appSettingStore']]);
        $this->middleware('permission:setting-contact', ['only' => ['contactInfoStore']]);
        $this->middleware('permission:setting-social', ['only' => ['socialMediaStore']]);
    }

    public function index()
    {
//        dd(config::get('LOGO_IMG'));
        $settings = SiteSetting::select(['setting_key', 'setting_value'])->get();
        return view('admin.setting.index', [
            'settings' => $settings,
        ]);
    }

    public function generalSettingStore(GeneralSettingStoreRequest $request)
    {

        if ($request->hasfile('LOGO_IMG')) {
            $logo = ImageUploadHelper::imageUpload($request->file('LOGO_IMG'), 'logo');
            DB::table('site_settings')->where('setting_key', 'LOGO_IMG')->update([
                'setting_value' => $logo
            ]);
        }
        if ($request->hasfile('FAVICON_IMG')) {
            $favicon_icon = ImageUploadHelper::imageUpload($request->file('FAVICON_IMG'), 'logo');
            DB::table('site_settings')->where('setting_key', 'FAVICON_IMG')->update([
                'setting_value' => $favicon_icon
            ]);
        }
        if ($request->hasfile('WEBSITE_MAIN_IMAGE')) {
            $favicon_icon = ImageUploadHelper::imageUpload($request->file('WEBSITE_MAIN_IMAGE'), 'logo');
            DB::table('site_settings')->where('setting_key', 'WEBSITE_MAIN_IMAGE')->update([
                'setting_value' => $favicon_icon
            ]);
        }
        if ($request->setting_key['SITE_TITLE']) {
            DB::table('site_settings')->where('setting_key', 'SITE_TITLE')->update([
                'setting_value' => $request->setting_key['SITE_TITLE']
            ]);
        }

        return response()->json(['message' => trans('admin_string.general_setting_update_successfully'),]);
    }

    public function emailSettingStore(EmailSettingStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
            Config::set([$key => $setting_value]);
        }
        return response()->json([
            'message' => trans('admin_string.email_setting_update_successfully'),
        ]);
    }

    public function appSettingStore(AppSettingStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);

        }
        return response()->json([
            'message' => trans('admin_string.app_setting_update_successfully'),
        ]);
    }

    public function contactInfoStore(ContactInfoStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
        }

        return response()->json([
            'message' => trans('admin_string.contact_info_update_successfully'),
        ]);
    }

    public function socialMediaStore(SocialMediaStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
        }

        return response()->json([
            'message' => trans('admin_string.social_media_update_successfully'),
        ]);
    }
    public function bankStoreStore(BankStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
        }

        return response()->json([
            'message' => trans('admin_string.bank_detail_update_successfully'),
        ]);
    }

}
