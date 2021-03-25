<?php

return [
    'coupons' => [
        'minimum_amount' => 20,
    ],

    'orders' => [
        'minimum_price' => 10,
    ],

    'preorders' => [
        'release_date_weeks' => 6,
    ],

    'invoices' => [
        'storage_folder' => storage_path('app/invoices') . '/',
        'file_prefix' => 'beehemiam_facture_n',
    ],

    'credits' => [
        'storage_folder' => storage_path('app/credits') . '/',
        'file_prefix' => 'beehemiam_avoir_n',
    ],

    'stocks' => [
        'min' => 10,
    ],
];
