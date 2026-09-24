<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class VideoTextWatermarkVideoOptions
{
    public function __construct(
        public readonly string $text,
        public readonly float $font_size = 48.0,
        public readonly string $color = '#FFFFFF80',
        public readonly VideoTextWatermarkVideoFontFamily $font_family = VideoTextWatermarkVideoFontFamily::LiberationSans,
        public readonly VideoTextWatermarkVideoWatermarkMode $watermark_mode = VideoTextWatermarkVideoWatermarkMode::Single,
        public readonly VideoTextWatermarkVideoAnchor $anchor = VideoTextWatermarkVideoAnchor::BottomRight,
        public readonly string $margin_x = '2%',
        public readonly string $margin_y = '2%',
        public readonly float $opacity = 1.0,
        public readonly ?float $rotation = null,
        public readonly ?int $tile_spacing = null,
    ) {}
}
