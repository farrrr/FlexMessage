<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;

class SpacerBuilder implements FlexBuilder
{
    /** @var string  */
    protected $size;
    /** @var array */
    protected $template;

    /**
     * SpacerBuilder constructor.
     *
     * @param string $size
     */
    public function __construct($size = 'md')
    {
        $this->size = $size;
    }

    public static function create(...$args)
    {
        return new static(...$args);
    }

    /**
     * Builds flex message structure.
     *
     * @return array Built flex message structure
     */
    public function build()
    {
        if (! empty($this->template)) {
            return $this->template;
        }

        $this->template = [
            'type' => FlexComponentType::SPACER,
            'size' => $this->size,
        ];

        return $this->template;
    }
}