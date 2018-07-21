<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;
use LINE\LINEBot\TemplateActionBuilder;

class ButtonBuilder implements FlexBuilder
{
    /** @var TemplateActionBuilder  */
    protected $actionBuilder;
    /** @var array  */
    protected $optionalProps;
    /** @var array */
    protected $template;

    /**
     * ButtonBuilder constructor.
     *
     * @param TemplateActionBuilder $actionBuilder
     * @param array                 $optionalProps
     */
    public function __construct(TemplateActionBuilder $actionBuilder, array $optionalProps = [])
    {
        $this->actionBuilder = $actionBuilder;
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
            'type' => FlexComponentType::BUTTON,
            'action' => $this->actionBuilder->buildTemplateAction(),
        ]);

        return $this->template;
    }
}