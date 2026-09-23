<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class SplitMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'beta',
            features: [
                'silence_mode_audio' => new FeatureEntry(
                    availability: 'beta',
                    description: 'Silence-detect cut mode for audio (`mode: silence` — server-side silence detection). `beta`: shape-stable + opt-in. The mode ships dark until the API regenerates enum validation to accept `mode: silence`. The `silence` enum value carries a matching `per_value_availability: beta` on `audio.mode`. ',
                ),
            ],
            mime_groups: [
                'image_gif' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'frame_range' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'output_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'document_pdf' => new MimeGroupMetadata(
                    availability: 'planned',
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'mode' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'page_range' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'page_groups' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'audio' => new MimeGroupMetadata(
                    availability: 'beta',
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'mode' => new OptionMetadata(
                            per_value_availability: [
                                'silence' => new AvailabilityEntry(
                                    availability: 'beta',
                                ),
                            ],
                        ),
                        'interval' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'count' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'cut_points' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'silence_threshold_db' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'silence_min_duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'silence_handling' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'precision' => new OptionMetadata(
                            per_value_availability: [
                                'exact' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                            ],
                        ),
                    ],
                    per_input_options: [],
                ),
                'video' => new MimeGroupMetadata(
                    availability: 'beta',
                    processing_class: [
                        'short_form' => new AvailabilityEntry(
                            availability: 'beta',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT5M',
                                max_input_size_bytes: 524288000,
                                max_output_size_bytes: 524288000,
                            ),
                        ),
                        'long_form' => new AvailabilityEntry(
                            availability: 'beta',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT12H',
                                max_input_size_bytes: 5000000000,
                                max_output_size_bytes: 5000000000,
                            ),
                        ),
                    ],
                    per_mime_availability: [],
                    options: [
                        'mode' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'interval' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'count' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'cut_points' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'precision' => new OptionMetadata(
                            per_value_availability: [
                                'exact' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                            ],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
