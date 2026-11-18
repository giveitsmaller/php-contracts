<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class MergeAudioM4aOptions
{
    public function __construct(
        public readonly MergeAudioM4aTransition $transition = MergeAudioM4aTransition::None,
        public readonly float $gap_duration = 0,
        public readonly bool $normalize_audio = true,
        public readonly ?MergeAudioM4aOutputType $output_type = null,
        public readonly ?MergeAudioM4aAudioFormat $audio_format = null,
        public readonly ?float $crossfade_duration = null,
    ) {}
}
