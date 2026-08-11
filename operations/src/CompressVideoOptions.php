<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class CompressVideoOptions
{
    public function __construct(
        public readonly CompressVideoOutputFormat $output_format = CompressVideoOutputFormat::Original,
        public readonly CompressVideoCodec $codec = CompressVideoCodec::H264,
        public readonly CompressVideoEncodingMode $encoding_mode = CompressVideoEncodingMode::Crf,
        public readonly CompressVideoPreset $preset = CompressVideoPreset::Medium,
        public readonly bool $faststart = true,
        public readonly CompressVideoAudioCodec $audio_codec = CompressVideoAudioCodec::Copy,
        public readonly ?int $crf = null,
        public readonly ?int $target_size_bytes = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?CompressVideoFit $fit = null,
        public readonly ?float $fps = null,
        public readonly ?CompressVideoAudioBitrate $audio_bitrate = null,
        public readonly ?float $trim_start = null,
        public readonly ?float $trim_end = null,
        public readonly ?float $speed = null,
    ) {}
}
