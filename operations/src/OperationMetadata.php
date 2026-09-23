<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class OperationMetadata
{
    /**
     * @param array<string, FeatureEntry>      $features
     * @param array<string, MimeGroupMetadata> $mime_groups
     * @param array<string, OptionMetadata>    $direct_options
     */
    public function __construct(
        public readonly array $features = [],
        public readonly array $mime_groups = [],
        public readonly array $direct_options = [],
        public readonly ?string $availability = null,
        public readonly ?string $required_tier = null,
        public readonly bool $sole_op = false,
    ) {}
}
