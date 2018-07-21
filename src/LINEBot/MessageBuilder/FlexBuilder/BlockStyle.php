<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

trait BlockStyle
{
    protected $styles = [];

    public function styles(array $styles)
    {
        $this->styles = $styles;

        return $this;
    }

    public function getStyles()
    {
        return $this->styles;
    }

}