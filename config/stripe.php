<?php

return [
    'key' => config('app.stripe.key', env('STRIPE_KEY')),
    'secret' => config('app.stripe.secret', env('STRIPE_SECRET')),
    'webhook_secret' => config('app.stripe.webhook_secret', env('STRIPE_WEBHOOK_SECRET')),
];


