<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page) {
            return view('website.page.index', ['page' => $page]);

        }
        abort(404);
    }

    public function contactUs()
    {
        return view('website.page.contact_us');
    }
    public function auction()
    {
        return view('website.auction.auction');
    }
}
