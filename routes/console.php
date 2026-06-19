<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('kakeibo:demo', function () {
    $this->info('Run php artisan migrate --seed, then sign in with demo@kakeibo.test / password.');
})->purpose('Show the Kakeibo demo account instructions');
