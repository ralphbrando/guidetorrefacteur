<?php

return [
    'mode' => config('app.paypal.mode', env('PAYPAL_MODE', 'live')),
    'client_id' => config('app.paypal.client_id', env('PAYPAL_CLIENT_ID')),
    'client_secret' => config('app.paypal.client_secret', env('PAYPAL_CLIENT_SECRET')),
    'currency' => 'EUR',
];


