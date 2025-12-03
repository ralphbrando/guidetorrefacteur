<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Departement;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/departements/{regionId}', function ($regionId) {
    return Departement::where('region_id', $regionId)->get();
});

