<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ConvertImageOptions
{
    public function __construct(
        public readonly ConvertImageOutputFormat $output_format,
        public readonly ConvertImageColorProfile $color_profile = ConvertImageColorProfile::Keep,
        public readonly bool $auto_orient = true,
        public readonly ?int $quality = null,
        public readonly ?string $background = null,
        public readonly ?ConvertImageMetadata $metadata = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?ConvertImageFit $fit = null,
    ) {}
}
