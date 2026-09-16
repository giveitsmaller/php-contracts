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
            features: [],
            mime_groups: [
                'audio' => new MimeGroupMetadata(
                    processing_class: [],
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
