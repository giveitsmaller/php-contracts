<?php

// Auto-generated -- do not edit

declare(strict_types=1);

namespace Gisl\Generated\Operations;

final class ThumbnailDocumentEpubOptions
{
    public function __construct(
        public readonly ThumbnailDocumentEpubSource $source = ThumbnailDocumentEpubSource::Cover,
        public readonly ThumbnailDocumentEpubFit $fit = ThumbnailDocumentEpubFit::Crop,
        public readonly ThumbnailDocumentEpubFormat $format = ThumbnailDocumentEpubFormat::Jpg,
        public readonly ?int $page = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?int $quality = null,
    ) {}
}
