<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class AudioOverlayMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'planned',
            features: [
                'multi_overlay_stack' => new FeatureEntry(
                    availability: 'planned',
                    description: 'Allow up to 8 overlay inputs per job (currently capped at 1 overlay). Per-overlay placement via per-input placement options. Backend support not yet confirmed; tagged `planned`. Mirrors the same-named feature on `image_watermark`. ',
                ),
                'sync_to_silence' => new FeatureEntry(
                    availability: 'planned',
                    description: 'Anchor overlay placement to detected silence regions in the base track (e.g. drop a podcast jingle into the natural breath after the host says "back in a sec"). Server-side silence detection runs at workflow-create time; the actual overlay start position is reported on `OperationMetrics.overlay_anchor_ms`. Gates two extra options: `silence_threshold_db` and `min_silence_ms`. backend support not yet shipped. ',
                ),
            ],
            mime_groups: [
                'audio' => new MimeGroupMetadata(
                    availability: 'planned',
                    processing_class: [
                        'short_form' => new AvailabilityEntry(
                            availability: 'planned',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT5M',
                                max_input_size_bytes: 524288000,
                                max_output_size_bytes: 524288000,
                            ),
                        ),
                        'long_form' => new AvailabilityEntry(
                            availability: 'planned',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT12H',
                                max_input_size_bytes: 5000000000,
                                max_output_size_bytes: 5000000000,
                            ),
                        ),
                    ],
                    per_mime_availability: [],
                    options: [
                        'start_at' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'overlay_gain_db' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'mode' => new OptionMetadata(
                            per_value_availability: [
                                'duck' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                            ],
                        ),
                        'duck_threshold' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duck_ratio' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duck_attack_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duck_release_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fade_in_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fade_out_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'loop' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'loop_interval' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'silence_threshold_db' => new OptionMetadata(
                            availability: 'planned',
                            per_value_availability: [],
                        ),
                        'min_silence_ms' => new OptionMetadata(
                            availability: 'planned',
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'video' => new MimeGroupMetadata(
                    availability: 'planned',
                    processing_class: [
                        'short_form' => new AvailabilityEntry(
                            availability: 'planned',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT5M',
                                max_input_size_bytes: 524288000,
                                max_output_size_bytes: 524288000,
                            ),
                        ),
                        'long_form' => new AvailabilityEntry(
                            availability: 'planned',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT12H',
                                max_input_size_bytes: 5000000000,
                                max_output_size_bytes: 5000000000,
                            ),
                        ),
                    ],
                    per_mime_availability: [],
                    options: [
                        'start_at' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'overlay_gain_db' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'mode' => new OptionMetadata(
                            per_value_availability: [
                                'duck' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                            ],
                        ),
                        'duck_threshold' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duck_ratio' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duck_attack_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duck_release_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fade_in_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fade_out_ms' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'loop' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'loop_interval' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'no_audio_track_behaviour' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'silence_threshold_db' => new OptionMetadata(
                            availability: 'planned',
                            per_value_availability: [],
                        ),
                        'min_silence_ms' => new OptionMetadata(
                            availability: 'planned',
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
