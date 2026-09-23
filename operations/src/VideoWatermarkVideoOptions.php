<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class VideoWatermarkVideoOptions
{
    public function __construct(
        public readonly VideoWatermarkVideoAnchor $anchor = VideoWatermarkVideoAnchor::BottomRight,
        public readonly string $margin_x = '2%',
        public readonly string $margin_y = '2%',
        public readonly float $opacity = 0.5,
        public readonly ?string $overlay_width = null,
    ) {}
}
