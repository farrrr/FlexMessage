<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;

class CarouselBuilder implements FlexBuilder
{
    /** @var FlexBuilder[] */
    protected $contentBuilders;
    /** @var array */
    protected $template;

    /**
     * CarouselBuilder constructor.
     *
     * @param array $contentBuilders
     */
    public function __construct(array $contentBuilders = [])
    {
        $this->contentBuilders = $contentBuilders;
    }

    public static function create(...$args)
    {
        return new static(...$args);
    }

    /**
     * @param FlexBuilder $containBuilder
     * @return $this
     */
    public function add(FlexBuilder $containBuilder)
    {
        $this->contentBuilders[] = $containBuilder;

        return $this;
    }

    /**
     * Builds flex message structure.
     *
     * @return array Bulit flex message structure
     */
    public function build()
    {
        if (! empty($this->template)) {
            return $this->template;
        }

        $contents = [];

        foreach ($this->contentBuilders as $contentBuilder) {
            $contents[] = $contentBuilder->build();
        }

        $this->template = [
            'type' => FlexComponentType::CAROUSEL,
            'contents' => $contents,
        ];

        return $this->template;
    }


}