<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class MergeAudioOptions
{
    public function __construct(
        public readonly MergeAudioTransition $transition = MergeAudioTransition::None,
        public readonly float $gap_duration = 0,
        public readonly bool $normalize_audio = true,
        public readonly ?MergeAudioOutputType $output_type = null,
        public readonly ?MergeAudioAudioFormat $audio_format = null,
        public readonly ?float $crossfade_duration = null,
    ) {}
}
