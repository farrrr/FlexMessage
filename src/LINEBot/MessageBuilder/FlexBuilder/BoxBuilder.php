<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;

class BoxBuilder implements FlexBuilder
{
    /** @var string */
    protected $layout;
    /** @var array  */
    protected $optionalProps;
    /** @var FlexBuilder[] */
    protected $contentBuilders;
    /** @var array */
    protected $template;

    /**
     * BoxBuilder constructor.
     *
     * @param       $layout
     * @param array $contentBuilders
     * @param array $optionalProps
     */
    public function __construct($layout, array $contentBuilders = [], array $optionalProps = [])
    {
        $this->layout = $layout;
        $this->optionalProps = $optionalProps;
        $this->contentBuilders = $contentBuilders;
    }

    public static function create(...$args)
    {
        return new static(...$args);
    }

    /**
     * @param FlexBuilder $contentBuilder
     * @return $this
     */
    public function add(FlexBuilder $contentBuilder)
    {
        $this->contentBuilders[] = $contentBuilder;

        return $this;
    }

    /**
     * Builds flex message structure.
     *
     * @return array Built flex message structure
     */
    public function build()
    {
        if (!empty($this->template)) {
            return $this->template;
        }

        $contents = [];

        foreach ($this->contentBuilders as $contentBuilder) {
            $contents[] = $contentBuilder->build();
        }

        $this->template =  array_merge_recursive($this->optionalProps, [
            'type' => FlexComponentType::BOX,
            'layout' => $this->layout,
            'contents' => $contents
        ]);

        return $this->template;
    }
}