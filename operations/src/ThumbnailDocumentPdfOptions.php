<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ThumbnailDocumentPdfOptions
{
    public function __construct(
        public readonly ThumbnailDocumentPdfSource $source = ThumbnailDocumentPdfSource::Page,
        public readonly ThumbnailDocumentPdfFit $fit = ThumbnailDocumentPdfFit::Crop,
        public readonly ThumbnailDocumentPdfFormat $format = ThumbnailDocumentPdfFormat::Jpg,
        public readonly ?int $page = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?int $quality = null,
    ) {}
}
