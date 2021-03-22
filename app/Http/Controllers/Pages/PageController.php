<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Country;
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
        return view('pages.sales-conditions', [
            'countries_list' => Country::all()->pluck('name')->join(', '),
        ]);
    }

    public function showDeliveryReturns(): View
    {
        return view('pages.delivery-returns');
    }
}
