<?php

Route::group(['prefix' => 'identicon', 'as' => 'identicon::'], function () {
    Route::get('d/{base_text}/{size?}/{text_hexcolors?}/{bg_color?}', ['as' => 'main', 'uses' => function ($base_text, $size = 64, $color = null, $backgroundColor = null) {
        return response(Identicon::getImageData($base_text, $size, $color, $backgroundColor), 200, ['Content-type' => 'image/png']);
    }]);
});
