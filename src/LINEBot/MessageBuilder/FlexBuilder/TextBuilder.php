<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;
use LINE\LINEBot\TemplateActionBuilder;

class TextBuilder implements FlexBuilder
{

    /** @var string  */
    protected $text;
    /** @var array  */
    protected $optionalProps;
    /** @var TemplateActionBuilder */
    protected $actionBuilder;
    /** @var array */
    protected $template;

    /**
     * TextBuilder constructor.
     *
     * @param string $text
     * @param array $optionalProps
     */
    public function __construct($text, array $optionalProps = [])
    {
        $this->text = $text;
        $this->optionalProps = $optionalProps;
    }

    public static function create(...$args)
    {
        return new static(...$args);
    }

    public function setAction(TemplateActionBuilder $actionBuilder)
    {
        $this->actionBuilder = $actionBuilder;
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
            'type' => FlexComponentType::TEXT,
            'text' => $this->text,
        ]);

        if ($this->actionBuilder) {
            $this->template['action'] = $this->actionBuilder->buildTemplateAction();
        }

        return $this->template;
    }
}