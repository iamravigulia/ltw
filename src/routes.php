<?php
use Illuminate\Support\Facades\Route;


Route::post('fmt/ltw/store', 'EdgeWizz\Ltw\Controllers\LtwController@store')->name('fmt.ltw.store');

Route::post('fmt/ltw/update/{id}', 'EdgeWizz\Ltw\Controllers\LtwController@update')->name('fmt.ltw.update');

Route::post('fmt/ltw/csv_upload', 'EdgeWizz\Ltw\Controllers\LtwController@csv_upload')->name('fmt.ltw.csv');
