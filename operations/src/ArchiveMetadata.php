<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ArchiveMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            sole_op: true,
            features: [],
            mime_groups: [],
            direct_options: [
                'format' => new OptionMetadata(
                    per_value_availability: [],
                ),
                'folder_structure' => new OptionMetadata(
                    per_value_availability: [
                        'by_job' => new AvailabilityEntry(
                            availability: 'planned',
                        ),
                    ],
                ),
            ],
        );
    }
}
