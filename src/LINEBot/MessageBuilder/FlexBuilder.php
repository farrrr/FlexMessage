<?php

namespace FarLab\LINEBot\MessageBuilder;

/**
 * The interface that has a responsibility to build flex message.
 *
 * @package FarLab\LINEBot\MessageBuilder
 */
interface FlexBuilder
{
    /**
     * Builds flex message structure.
     *
     * @return array Built flex message structure
     */
    public function build();
}