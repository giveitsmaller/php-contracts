<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ImageWatermarkMetadata
{
    public static function instance(): OperationMetadata
    {
        return new OperationMetadata(
            features: [
                'multi_overlay_stack' => new FeatureEntry(
                    availability: 'stable',
                    description: 'Stack up to 8 overlay inputs on one base image, each with its own placement via the `overlays[]` array option (index-aligned to the overlay-role sources; see the `image` group\'s `overlays` option). `overlays[]` is mutually exclusive with the flat single-overlay options, which remain the 1-overlay back-compat path.  **Base-format scope: multi-overlay (`overlays[]`) is on the `image` group (jpeg/png/webp) ONLY** — the format the worker proved. The stable `image_tiff` / `image_bmp` bases support the SINGLE-overlay flat options but NOT `overlays[]` yet (multi-overlay on those bases needs its own worker proof — a base-format extension, separate from the group\'s stable single-overlay flip). GIF / video bases remain out of scope.  The op-level `input` max 9 / `per_role_cardinality` overlay `{1,8}` is the MAXIMUM (the jpeg/png/webp base); input-cardinality has no per-mime- group primitive, so a `>1`-overlay request on a tiff/bmp base — which has no `overlays[]` to place the extra overlays — is rejected as `invalid_options` (API + worker). Effective per-base overlay count: jpeg/png/webp = 1–8, tiff/bmp = 1. ',
                ),
            ],
            mime_groups: [
                'image' => new MimeGroupMetadata(
                    processing_class: [],
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
                        'overlays' => new OptionMetadata(
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
                'image_tiff' => new MimeGroupMetadata(
                    processing_class: [],
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
                'image_bmp' => new MimeGroupMetadata(
                    processing_class: [],
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
