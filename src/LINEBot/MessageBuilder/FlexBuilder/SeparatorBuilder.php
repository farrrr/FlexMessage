<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;

class SeparatorBuilder implements FlexBuilder
{
    /** @var array  */
    protected $optionalProps;
    /** @var array */
    protected $template;

    public function __construct(array $optionalProps = [])
    {
        $this->optionalProps = $optionalProps;
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

        $this->template = array_merge_recursive($this->optionalProps, [
            'type' => FlexComponentType::SEPARATOR,
        ]);

        return $this->template;
    }
}