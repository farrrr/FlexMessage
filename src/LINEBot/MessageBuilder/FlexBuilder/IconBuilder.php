<?php

namespace FarLab\LINEBot\MessageBuilder\FlexBuilder;

use FarLab\LINEBot\Constant\FlexComponentType;
use FarLab\LINEBot\MessageBuilder\FlexBuilder;

class IconBuilder implements FlexBuilder
{
    /** @var string */
    protected $url;
    /** @var array  */
    protected $optionalProps;
    /** @var array */
    protected $template;

    /**
     * IconBuilder constructor.
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
            'type' => FlexComponentType::ICON,
            'url' => $this->url,
        ]);

        return $this->template;
    }
}