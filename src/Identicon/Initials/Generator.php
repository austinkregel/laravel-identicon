<?php

namespace Kregel\Identicon\Initials;

use Faker\Provider\Image;
use Identicon\Generator\BaseGenerator;
use Imagick;
use ImagickDraw;
use ImagickPixel;

class Generator extends BaseGenerator
{
    private $text;

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    private function merge(array $one, array $two)
    {
        foreach ($two as $key => $value) {
            if (empty($one[$key])) {
                if (!empty($two[$key])) {
                    $one[$key] = $two[$key];
                }
            }
        }

        return $one;
    }

    public function getMimeType()
    {
        return 'image/png';
    }

    private function generateImage()
    {
        $this->generatedImage = new \Imagick();
        $rgbBackgroundColor = $this->getBackgroundColor();
        if (null === $rgbBackgroundColor) {
            $background = new ImagickPixel('none');
        } else {
            $background = new ImagickPixel("rgb($rgbBackgroundColor[0],$rgbBackgroundColor[1],$rgbBackgroundColor[2])");
        }
        $color = $this->getColor();
        $txtcolor = new \ImagickPixel("rgb($color[0],$color[1],$color[2])");
        $text = $this->getText();
        $size = $this->getSize();
        /* Create an ImagickDraw object */
        $draw = new ImagickDraw();
        /* Set the font */
        $draw->setFont(__DIR__.'/../../fonts/Roboto-Regular.ttf');
        $draw->setFillColor($txtcolor);
        $draw->setStrokeWidth(2.0);
        $font_size = $size / ((strlen($text) / (strlen(strlen($text))))) + 4;
        $draw->setFontSize($font_size);
        $draw->setGravity(Imagick::GRAVITY_CENTER);

        $this->generatedImage->newImage($size, $size, $background);
        $this->generatedImage->annotateImage($draw, 0, 0, 0, $text);
        $this->generatedImage->setImageFormat('png');
        $this->generatedImage->drawImage($draw);

        return $this;
    }

    public function getImageData($string, $size = 64, $color = null, $backgroundColor = null)
    {
        return $this->getImageBinaryData($string, $size, $color, $backgroundColor);
    }

    /**
     * {@inheritdoc}
     */
    public function getImageBinaryData($string, $size = null, $color = null, $backgroundColor = null)
    {
        ob_start();
        echo $this->getImageResource($string, $size, $color, $backgroundColor);
        $imageData = ob_get_contents();
        ob_end_clean();

        return $imageData;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageResource($string, $size = null, $color = null, $backgroundColor = null)
    {
        if (empty($color)) {
            //            $color = '333333';
        }
        if (!empty($backgroundColor)) {
            $backgroundColor = '#'.$backgroundColor;
        }
        $this
            ->setText($string)
            ->setSize($size)
            ->setColor($backgroundColor)
            ->setBackgroundColor($color)
            ->generateImage();

        return $this->generatedImage;
    }
}
