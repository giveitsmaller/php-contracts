<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class AudioOverlayAudioOptions
{
    public function __construct(
        public readonly float $start_at = 0.0,
        public readonly float $overlay_gain_db = -3.0,
        public readonly AudioOverlayAudioMode $mode = AudioOverlayAudioMode::Mix,
        public readonly int $fade_in_ms = 0,
        public readonly int $fade_out_ms = 0,
        public readonly bool $loop = false,
        public readonly ?float $duration = null,
        public readonly ?float $duck_threshold = null,
        public readonly ?float $duck_ratio = null,
        public readonly ?int $duck_attack_ms = null,
        public readonly ?int $duck_release_ms = null,
        public readonly ?float $loop_interval = null,
        public readonly ?float $silence_threshold_db = null,
        public readonly ?int $min_silence_ms = null,
    ) {}
}
