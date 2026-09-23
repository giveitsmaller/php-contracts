<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class AudioWatermarkMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'planned',
            features: [],
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
                        'payload' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'method' => new OptionMetadata(
                            per_value_availability: [
                                'neural' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                            ],
                        ),
                        'robustness' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'density' => new OptionMetadata(
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
                        'payload' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'method' => new OptionMetadata(
                            per_value_availability: [
                                'neural' => new AvailabilityEntry(
                                    availability: 'planned',
                                ),
                            ],
                        ),
                        'robustness' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'density' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
