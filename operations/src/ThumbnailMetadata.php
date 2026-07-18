<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ThumbnailMetadata
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
                        'width' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'height' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fit' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'quality' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'background' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'video' => new MimeGroupMetadata(
                    processing_class: [
                        'short_form' => new AvailabilityEntry(
                            availability: 'stable',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT5M',
                                max_input_size_bytes: 524288000,
                            ),
                        ),
                        'long_form' => new AvailabilityEntry(
                            availability: 'planned',
                            required_tier: 'pro',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT12H',
                                max_input_size_bytes: 5000000000,
                            ),
                        ),
                    ],
                    per_mime_availability: [],
                    options: [
                        'timestamp' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'width' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'height' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fit' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'quality' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'document' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'source' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'page' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'width' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'height' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fit' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'quality' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'document_epub' => new MimeGroupMetadata(
                    availability: 'planned',
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'source' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'page' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'width' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'height' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fit' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'quality' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
