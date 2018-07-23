<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;

class BubbleBuilder implements FlexBuilder
{
    /** @var HeaderBuilder */
    protected $headerBuilder;
    /** @var HeroBuilder */
    protected $heroBuilder;
    /** @var BodyBuilder */
    protected $bodyBuilder;
    /** @var FooterBuilder */
    protected $footerBuilder;
    /** @var array */
    protected $styles;
    /** @var string  */
    protected $direction = 'ltr';
    /** @var array */
    protected $template;
    /** @var array  */
    protected $sections = ['header', 'hero', 'body', 'footer'];

    public static function create()
    {
        return new static();
    }

    /**
     * @param HeaderBuilder $headerBuilder
     * @return $this
     */
    public function header(HeaderBuilder $headerBuilder)
    {
        $this->headerBuilder = $headerBuilder;
        $this->setStyles('header', $headerBuilder->getStyles());

        return $this;
    }

    /**
     * @param HeroBuilder $heroBuilder
     * @return $this
     */
    public function hero(HeroBuilder $heroBuilder)
    {
        $this->heroBuilder = $heroBuilder;
        $this->setStyles('hero', $heroBuilder->getStyles());

        return $this;
    }

    /**
     * @param BodyBuilder $bodyBuilder
     * @return $this
     */
    public function body(BodyBuilder $bodyBuilder)
    {
        $this->bodyBuilder = $bodyBuilder;
        $this->setStyles('body', $bodyBuilder->getStyles());

        return $this;
    }

    /**
     * @param FooterBuilder $footerBuilder
     * @return $this
     */
    public function footer(FooterBuilder $footerBuilder)
    {
        $this->footerBuilder = $footerBuilder;
        $this->setStyles('footer', $footerBuilder->getStyles());

        return $this;
    }

    /**
     * @param string $direction
     * @return $this
     */
    public function direction($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @param string $block
     * @param array $styles
     */
    protected function setStyles($block, array $styles)
    {
        if (! empty($styles)) {
            $this->styles[$block] = $styles;
        }
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
            'type' => FlexComponentType::BUBBLE,
            'direction' => $this->direction,
        ];

        foreach ($this->sections as $section) {
            $builder = $section . "Builder";

            if ($this->{$builder}) {
                $this->template[$section] = $this->{$builder}->build();
            }
        }

        if (! empty($this->styles)) {
            $this->template['styles'] = $this->styles;
        }

        return $this->template;
    }
}