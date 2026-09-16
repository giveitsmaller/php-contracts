<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class VideoTextWatermarkMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'planned',
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
                            required_tier: 'pro',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT12H',
                                max_input_size_bytes: 5000000000,
                                max_output_size_bytes: 5000000000,
                            ),
                        ),
                    ],
                    per_mime_availability: [],
                    options: [
                        'text' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'font_size' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'color' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'font_family' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'rotation' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'watermark_mode' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'tile_spacing' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'anchor' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'margin_x' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'margin_y' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'opacity' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
