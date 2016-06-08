<?php

Route::group(['prefix' => config('kregel.identicon.route'), 'as' => 'identicon::'], function () {
    Route::get('p/{base_text}/{size?}/{text_hexcolors?}/{bg_color?}', ['as' => 'main', 'uses' => function ($base_text, $size = 64, $color = null, $backgroundColor = null) {
        $idencticon = new \Identicon\Identicon();

        return response($idencticon->getImageData($base_text, $size, $color, $backgroundColor), 200, ['Content-type' => 'image/png']);
    }]);

    Route::get('i/{base_text}/{size?}/{text_hexcolors?}/{bg_color?}', ['as' => 'text', 'uses' => function ($base_text, $size = 64, $color = null, $backgroundColor = null) {
        $idencticon = new Kregel\Identicon\Initials\Generator();

        return response($idencticon->getImageData($base_text, $size, $color, $backgroundColor), 200, ['Content-type' => 'image/png']);
    }]);
});
