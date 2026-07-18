# PHP -- Operation Option Models

> **Auto-generated** -- do not edit manually. Changes will be overwritten on the next generation run.
>
> Regenerate with: `make project/generate-tests`

## Source

- **Spec:** `compression_contracts/schemas/operations/*.yaml` (custom schema format)
- **Generator:** Custom Python emitter (`scripts/generators/operation_schema/php.py`)
- **Files:** 214

## Contents

PHP 8.1 backed enums and readonly classes for per-operation options, using PSR-4 autoloading under the `Gisl\Generated\Operations` namespace.

Operation types covered: archive, audio_overlay, audio_to_video, audio_watermark, compress, convert, custom_luma, image_watermark, merge, passthrough, render_variants, split, text_watermark, thumbnail, transform, video_text_watermark, video_watermark.
