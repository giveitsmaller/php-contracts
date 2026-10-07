<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class AudioToVideoMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            availability: 'planned',
            sole_op: true,
            features: [],
            mime_groups: [
                'audio' => new MimeGroupMetadata(
                    processing_class: [
                        'short_form' => new AvailabilityEntry(
                            availability: 'planned',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT29M43S',
                            ),
                        ),
                        'long_form' => new AvailabilityEntry(
                            availability: 'planned',
                            constraints: new ProcessingClassConstraints(
                                max_input_duration: 'PT2H',
                            ),
                        ),
                    ],
                    per_mime_availability: [],
                    options: [
                        'output_resolution' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'background_color' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'image_fit' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'framerate' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                        'output_format' => new OptionMetadata(
                            per_value_availability: [],
                        ),
                    ],
                    per_input_options: [],
                ),
            ],
        );
    }
}
