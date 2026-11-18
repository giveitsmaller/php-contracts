<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ConvertVideoQuicktimeOptions
{
    public function __construct(
        public readonly ConvertVideoQuicktimeOutputFormat $output_format,
        public readonly ?int $crf = null,
        public readonly ?float $trim_start = null,
        public readonly ?float $trim_end = null,
        public readonly ?float $fps = null,
        public readonly ?int $width = null,
        public readonly ?int $max_colors = null,
        public readonly ?int $loop = null,
        public readonly ?ConvertVideoQuicktimeDither $dither = null,
    ) {}
}
