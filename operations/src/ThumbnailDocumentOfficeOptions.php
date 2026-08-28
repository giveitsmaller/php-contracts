<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ThumbnailDocumentOfficeOptions
{
    public function __construct(
        public readonly ThumbnailDocumentOfficeSource $source = ThumbnailDocumentOfficeSource::Page,
        public readonly ThumbnailDocumentOfficeFit $fit = ThumbnailDocumentOfficeFit::Crop,
        public readonly ThumbnailDocumentOfficeFormat $format = ThumbnailDocumentOfficeFormat::Jpg,
        public readonly ?int $page = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?int $quality = null,
    ) {}
}
