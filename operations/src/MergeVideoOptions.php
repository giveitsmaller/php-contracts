<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class MergeVideoOptions
{
    public function __construct(
        public readonly MergeVideoTransition $transition = MergeVideoTransition::None,
        public readonly bool $normalize_audio = false,
        public readonly MergeVideoReEncodeMode $re_encode_mode = MergeVideoReEncodeMode::Auto,
        public readonly ?MergeVideoOutputType $output_type = null,
        public readonly ?float $crossfade_duration = null,
        public readonly ?MergeVideoCodec $codec = null,
        public readonly ?int $crf = null,
        public readonly ?MergeVideoPreset $preset = null,
        public readonly ?string $target_resolution = null,
        public readonly ?MergeVideoEncodingMode $encoding_mode = null,
        public readonly ?int $target_size_bytes = null,
    ) {}
}
