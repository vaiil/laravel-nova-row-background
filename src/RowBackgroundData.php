<?php


namespace Upline\RowBackground;

use InvalidArgumentException;
use JsonSerializable;

class RowBackgroundData implements JsonSerializable
{
    /**
     * @var string
     */
    private $backgroundColor;
    /**
     * @var string|null
     */
    private $textColor;

    public function __construct(string $backgroundColor, string $textColor = null)
    {
        if (!preg_match('/^#[A-Fa-f0-9]{6}$/', $backgroundColor)) {
            throw new InvalidArgumentException('Wrong background color format, available format: #FFFFFF');
        }

        if ($textColor && !preg_match('/^#[A-Fa-f0-9]{6}$/', $textColor)) {
            throw new InvalidArgumentException('Wrong text color format, available format: #FFFFFF');
        }

        $this->backgroundColor = $backgroundColor;
        $this->textColor = $textColor;
    }

    public function jsonSerialize()
    {
        return [
            'backgroundColor' => $this->backgroundColor,
            'textColor' => $this->textColor
        ];
    }
}
