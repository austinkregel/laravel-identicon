<?php

Route::group(['prefix' => config('kregel.identicon.route'), 'as' => 'identicon::'], function () {
    Route::get('p/{base_text}/{size?}/{text_hexcolors?}/{bg_color?}', ['as' => 'main', 'uses' => function ($base_text, $size = 64, $color = null, $backgroundColor = null) {
        return response(Identicon::getImageData($base_text, $size, $color, $backgroundColor), 200, ['Content-type' => 'image/png']);
    }]);
});

