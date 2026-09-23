<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ConvertMetadata
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
                        'output_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'quality' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'background' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'metadata' => new OptionMetadata(
                            availability: 'planned',
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
                        'color_profile' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'auto_orient' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'image_svg' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'output_format' => new OptionMetadata(
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
                'image_gif' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'output_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'quality' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'background' => new OptionMetadata(
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
                        'color_profile' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'auto_orient' => new OptionMetadata(
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
                        'output_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'crf' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'trim_start' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'trim_end' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'fps' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'width' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'max_colors' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'loop' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'dither' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'audio' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'output_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'bitrate' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
                'document_pdf' => new MimeGroupMetadata(
                    processing_class: [],
                    per_mime_availability: [],
                    options: [
                        'output_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'pages' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'dpi' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
