<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class MergeMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            features: [],
            mime_groups: [
                'image' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'output_type' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'delay' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'loop_count' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'duration_per_image' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'transition' => new OptionMetadata(
                            per_value_availability: [
                                'smoothleft' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothright' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothup' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothdown' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circleopen' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circleclose' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circlecrop' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'rectcrop' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideleft' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideright' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideup' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slidedown' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'radial' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagtl' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagtr' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagbl' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'pixelize' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'hlslice' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'vlslice' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'hblur' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'distance' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'squeezeh' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'custom' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                                'wipetl' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                                'wipetr' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                                'wipebl' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                            ],
                        ),
                        'transition_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fps' => new OptionMetadata(
                            availability: 'planned',
                            per_value_availability: [],
                        ),
                        'video_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'video' => new MimeGroupMetadata(
                    processing_class: [
                        'short_form_concat' => new AvailabilityEntry(
                            availability: 'stable',
                            constraints: new ProcessingClassConstraints(
                                max_total_duration: 'PT5M',
                                max_total_input_size_bytes: 1073741824,
                            ),
                        ),
                        'long_form_re_encode' => new AvailabilityEntry(
                            availability: 'stable',
                            required_tier: 'pro',
                            constraints: new ProcessingClassConstraints(
                                max_total_duration: 'PT24H',
                                max_total_input_size_bytes: 5000000000,
                            ),
                        ),
                    ],
                    per_mime_availability: [],
                    options: [
                        'output_type' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'transition' => new OptionMetadata(
                            per_value_availability: [
                                'smoothleft' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothright' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothup' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothdown' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circleopen' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circleclose' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circlecrop' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'rectcrop' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideleft' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideright' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideup' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slidedown' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'radial' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagtl' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagtr' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagbl' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'pixelize' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'hlslice' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'vlslice' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'hblur' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'distance' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'squeezeh' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'custom' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                                'wipetl' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                                'wipetr' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                                'wipebl' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                            ],
                        ),
                        'crossfade_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'normalize_audio' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        're_encode_mode' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'codec' => new OptionMetadata(
                            per_value_availability: [
                                'av1' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                            ],
                        ),
                        'crf' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'preset' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'target_resolution' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'encoding_mode' => new OptionMetadata(
                            per_value_availability: [
                                'target_size' => new AvailabilityEntry(
                                    availability: 'stable',
                                ),
                            ],
                        ),
                        'target_size_bytes' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [
                        'transition' => new OptionMetadata(
                            per_value_availability: [
                                'smoothleft' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothright' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothup' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'smoothdown' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circleopen' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circleclose' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'circlecrop' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'rectcrop' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideleft' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideright' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slideup' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'slidedown' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'radial' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagtl' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagtr' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'diagbl' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                                'pixelize' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'hlslice' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'vlslice' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'hblur' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'distance' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'squeezeh' => new AvailabilityEntry(
                                    availability: 'experimental',
                                ),
                                'custom' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                                'wipetl' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                                'wipetr' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                                'wipebl' => new AvailabilityEntry(
                                    availability: 'planned',
                                    eta: '2026-Q3',
                                ),
                            ],
                        ),
                        'crossfade_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'trim_start' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'trim_end' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                ),
                'audio' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'output_type' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'transition' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'crossfade_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'gap_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'normalize_audio' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [
                        'transition' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'crossfade_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'gap_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'trim_start' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'trim_end' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                ),
            ],
        );
    }
}
