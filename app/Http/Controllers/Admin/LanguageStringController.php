<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminDataTableButtonHelper;
use App\Helpers\CacheClearHelper;
use App\Helpers\CatchCreateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageStringStoreRequest;
use App\Models\Language;
use App\Models\LanguageString;
use App\Models\LanguageStringTranslation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class LanguageStringController extends Controller
{
    public function index()
    {
        CacheClearHelper::languageStringCacheClear();
        CatchCreateHelper::getLanguageStringCatch('admin_string', App::getLocale());

        $languageStrings = LanguageString::all();

//        $staging_strings = DB::connection('mysql5')->table('language_strings')->get();
//
//        foreach ($staging_strings as $staging_string) {
//            if (LanguageString::where('app_or_panel', $staging_string->app_or_panel)->where('name_key', $staging_string->name_key)->count() == 0) {
//                $ids[] = $staging_string->name_key;
//                $language_string_translations = DB::connection('mysql5')->table('language_string_translations')->where('language_string_id', $staging_string->id)->get();
//                $adminString = new LanguageString();
//                $adminString->name_key = $staging_string->name_key;
//                $adminString->app_or_panel = $staging_string->app_or_panel;
//                $adminString->save();
//                foreach ($language_string_translations as $language_string_translation) {
//                    LanguageStringTranslation::create([
//                        'name' => $language_string_translation->name,
//                        'language_string_id' => $adminString->id,
//                        'locale' => $language_string_translation->locale,
//                    ]);
//                }
//            }
//        }
//        dd($ids);
        return view('admin.language-string.index', [
            'languageStrings' => $languageStrings
        ]);
    }

    public function create()
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.language-string.create', [
            'languages' => $languages
        ]);
    }

    public function store(LanguageStringStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        DB::beginTransaction();

        if ($validated['edit_value'] == 0) {
            try {
                $language_string = new LanguageString();
                $language_string->app_or_panel = $validated['app_or_panel'];
                $language_string->name_key = $validated['name_key'];
                $language_string->save();
                $languages = CatchCreateHelper::getLanguage(App::getLocale());
                foreach ($languages as $language) {
                    LanguageStringTranslation::create([
                        'name' => $request->input($language['language_code'] . '_name'),
                        'language_string_id' => $language_string->id,
                        'locale' => $language['language_code'],
                    ]);
                }
                DB::commit();

//                Http::get('https://127.0.0.1:8000/admin/create-language-string-file');
//                CacheClearHelper::languageStringCacheClear();
                return response()->json([
                    'message' => 'Added Successfully'
                ]);
            } catch (Exception $exception) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 522);
            }
        } else {
            try {
                $language_string = LanguageString::findorfail($validated['edit_value']);
                $language_string->app_or_panel = $validated['app_or_panel'];
                $language_string->save();

                $languages = CatchCreateHelper::getLanguage(App::getLocale());
                foreach ($languages as $language) {
                    LanguageStringTranslation::updateOrCreate(
                        [
                            'language_string_id' => $validated['edit_value'],
                            'locale' => $language['language_code'],
                        ],
                        [
                            'language_string_id' => $validated['edit_value'],
                            'locale' => $language['language_code'],
                            'name' => $request->input($language['language_code'] . '_name'),
                        ]);
                }
                DB::commit();


//                    Http::get( 'create-language-string-file');
//                dd(33);
                CacheClearHelper::languageStringCacheClear();

                return response()->json([
                    'message' => trans('admin_string.language_string_updated')
                ]);
            } catch (Exception $exception) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 522);
            }
        }
    }

    public function edit(int $id)
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        $languageString = LanguageString::findorfail($id);
        return view('admin.language-string.edit', [
            "languageString" => $languageString,
            "languages" => $languages
        ]);
    }

    public function destroy($id): JsonResponse
    {
        LanguageString::where('id', $id)->delete();

        return response()->json([
            'success' => true, 'status_code' => 200,
            'message' => trans('admin_string.language_string_deleted')
        ]);
    }

    public function changeStatus($id, $status): JsonResponse
    {
        LanguageString::query()
            ->where('id', $id)
            ->update(['status' => $status]);

        return response()->json([
            'message' => trans('admin_string.change_status_message'),
        ]);
    }

    public function createLanguageStringFile(): RedirectResponse
    {
        $languages = Language::where('status', 'active')->get();
          foreach ($languages as $language) {
            $language_strings = LanguageString::where('app_or_panel', 'admin')->get();
            $admin_array = [];
            foreach ($language_strings as $language_string) {
                $admin_array[$language_string->name_key] = $language_string->translateOrNew($language->language_code)->name;
            }
            $admin_data = var_export($admin_array, 1);
            File::put(base_path() . '/resources/lang/' . $language->language_code . '/admin_string.php', "<?php\n return $admin_data;");

            $language_strings = LanguageString::where('app_or_panel', 'web')->get();
            $web_array = [];
            foreach ($language_strings as $language_string) {
                $web_array[$language_string->name_key] = $language_string->translateOrNew($language->language_code)->name;
            }
            $web_data = var_export($web_array, 1);
            File::put(base_path() . '/resources/lang/' . $language->language_code . '/web_string.php', "<?php\n return $web_data;");

            $language_strings = LanguageString::where('app_or_panel', 'app')->get();
            $app_array = [];
            foreach ($language_strings as $language_string) {
                $app_array[$language_string->name_key] = $language_string->translateOrNew($language->language_code)->name;
            }
            $app_data = var_export($app_array, 1);
            File::put(base_path() . '/resources/lang/' . $language->language_code . '/app_string.php', "<?php\n return $app_data;");

        }

        return redirect()->route('admin.language-string.index');
    }

    public function getLanguageStringList(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('language_strings')
                ->leftJoin('language_string_translations', 'language_strings.id', 'language_string_translations.language_string_id')
                ->where('language_string_translations.locale', App::getLocale());
            $languageStrings = $query->select('language_strings.*', 'language_string_translations.name as name');
            return Datatables::of($languageStrings)
                ->addColumn('action', function ($languageStrings) {
                    $array = [
                        'id' => $languageStrings->id,
                        'actions' => [
                            'edit' => route('admin.language-string.edit', [$languageStrings->id]),
                            'delete' => '',
                        ]
                    ];
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
