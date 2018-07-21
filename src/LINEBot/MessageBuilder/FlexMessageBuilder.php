<?php

namespace FarLab\LINEBot\MessageBuilder;

use FarLab\LINEBot\Constant\MessageType;
use LINE\LINEBot\MessageBuilder;

/**
 * A builder class for flex message
 *
 * @package FarLab\LINEBot\MessageBuilder
 */
class FlexMessageBuilder implements MessageBuilder
{

    /** @var string */
    protected $altText;
    /** @var FlexBuilder */
    protected $container;

    /**
     * FlexMessageBuilder constructor.
     *
     * @param             $altText
     * @param FlexBuilder $container
     */
    public function __construct($altText, FlexBuilder $container)
    {
        $this->altText = $altText;
        $this->container = $container;
    }

    public static function create(...$args)
    {
        return new static(...$args);
    }

    /**
     * Builds message structure.
     *
     * @return array Built message structure.
     */
    public function buildMessage()
    {
        return [
            'type' => MessageType::FLEX,
            'altText' => $this->altText,
            'contents' => $this->container->build(),
        ];
    }
}