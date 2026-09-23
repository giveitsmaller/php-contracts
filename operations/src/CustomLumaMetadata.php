<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class CustomLumaMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'planned',
            sole_op: true,
            features: [],
            mime_groups: [
                'video' => new MimeGroupMetadata(
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
                        'duration' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'start_offset' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'mask_contrast' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'mask_blur' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'mask_invert' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
