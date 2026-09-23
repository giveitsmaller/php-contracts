<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class VideoWatermarkMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'planned',
            features: [
                'multi_overlay_stack' => new FeatureEntry(
                    availability: 'planned',
                    description: 'Allow up to 8 overlay inputs per job (currently capped at 1 overlay). Per-overlay placement via per-input placement options. Backend support not yet confirmed; tagged planned. Mirrors the same-named feature on `image_watermark`. ',
                ),
            ],
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
                        'overlay_width' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
