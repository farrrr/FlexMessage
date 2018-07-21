<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;
use LINE\LINEBot\TemplateActionBuilder;

class ImageBuilder implements FlexBuilder
{
    /** @var string */
    protected $url;
    /** @var array  */
    protected $optionalProps;
    /** @var TemplateActionBuilder */
    protected $actionBuilder;
    /** @var array */
    protected $template;

    /**
     * ImageBuilder constructor.
     *
     * @param       $url
     * @param array $optionalProps
     */
    public function __construct($url, array $optionalProps = [])
    {
        $this->url = $url;
        $this->optionalProps = $optionalProps;
    }

    public static function create(...$args)
    {
        return new static(...$args);
    }

    /**
     * @param TemplateActionBuilder $actionBuilder
     * @return $this
     */
    public function setAction(TemplateActionBuilder $actionBuilder)
    {
        $this->actionBuilder = $actionBuilder;

        return $this;
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
            'type' => FlexComponentType::IMAGE,
            'url' => $this->url,
        ]);

        if ($this->actionBuilder) {
            $this->template['action'] = $this->actionBuilder->buildTemplateAction();
        }

        return $this->template;
    }
}