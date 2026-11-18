<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class MergeAudioM4aPerInputOptions
{
    public function __construct(
        public readonly ?MergeAudioM4aTransition $transition = null,
        public readonly ?float $crossfade_duration = null,
        public readonly ?float $gap_duration = null,
        public readonly ?float $trim_start = null,
        public readonly ?float $trim_end = null,
    ) {}
}
