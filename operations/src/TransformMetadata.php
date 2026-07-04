<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class TransformMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'planned',
            features: [],
            mime_groups: [
                'image' => new MimeGroupMetadata(
                    availability: 'planned',
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'rotate' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'flip' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'image_gif' => new MimeGroupMetadata(
                    availability: 'planned',
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'rotate' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'flip' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
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
                        'rotate' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'flip' => new OptionMetadata(
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
                        'rotate' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
