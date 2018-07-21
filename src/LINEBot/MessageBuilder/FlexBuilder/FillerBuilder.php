<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;

class FillerBuilder implements FlexBuilder
{
    public static function create()
    {
        return new static();
    }

    /**
     * Builds flex message structure.
     *
     * @return array Built flex message structure
     */
    public function build()
    {
        return [
            'type' => FlexComponentType::FILLER,
        ];
    }
}