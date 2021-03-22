<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function showTermsAndConditions(): View
    {
        return view('pages.terms-conditions');
    }

    public function showPrivacyPolicy(): View
    {
        return view('pages.privacy-policy');
    }

    public function showSalesConditions(): View
    {
        return view('pages.sales-conditions');
    }
}
