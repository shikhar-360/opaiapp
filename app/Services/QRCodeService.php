<?php
namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class QRCodeService
{
    public function generate(string $text, int $size = 300)
    {
        $options = new QROptions([
            'version' => 5,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'scale' => 10,
        ]);

        $imageData = (new QRCode($options))->render($text);
        
        return $imageData;
    }
}