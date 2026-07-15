<?php
/**
 * MetadataResponse
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * GISL Compression API
 *
 * REST API for the GISL (Give It Smaller) file compression and processing service.  **Architecture:** - Upload files to get a `file_id` - Create workflows referencing uploaded files with operations (compress, thumbnail, image_watermark, text_watermark, merge, archive, convert, custom_luma, audio_overlay, audio_watermark) - Poll status, stream SSE events, or receive webhook callbacks - Download results per operation output  **Response envelope:** All mutation and query endpoints return `{ success: true, data: {...} }` on success and `{ success: false, error: \"...\", details: [...] }` on failure. Exceptions: `GET /api/operations/schema` returns raw JSON (per-tier private caching with ETag revalidation per ADR-0002 + I3), health probes return flat objects, and `POST /api/contact` returns 204 with no body.  **Availability metadata.** This spec uses the `x-availability` vendor extension as **decorative documentation only**. Per [ADR-0001](../docs/decisions/0001-contract-first-availability.md) §1.5, the runtime endpoint `GET /api/operations/schema` (ticket I3) is the authoritative source; the sidecar `availability.json` (ticket I3b) is the authoritative companion (generated, never hand-edited; CI cross-checks runtime ⇄ sidecar). SDKs MUST NOT depend on `x-availability` reaching generated code — code-generators that surface vendor extensions may emit it as documentation, but consumers read availability from the runtime endpoint, not from the generated bindings.  The 5-value vocabulary (`stable | beta | experimental | planned | deprecated`) is defined in the `AvailabilityValue` schema. See `schemas/FORMAT.md` §Availability Taxonomy for the operational rules (parser obligation: absent = stable; per-enum-value granularity is the `per_value_availability` primitive landed via ticket I17).  **Localisation (per ticket [I26](https://trello.com/c/rcnqwgI4)).**  Error responses + paused/blocked workflow statuses carry a localised human-readable `message` alongside a stable, never-localised `message_key`. Machine-readable fields (`error`, enum values, status codes) stay canonical English.  - **Currently committed locales:** `en-GB` only (per ticket   [`4GKyuYo6`](https://trello.com/c/4GKyuYo6)). The I26 carrier   shape (`Accept-Language` + `Content-Language` + `Vary` headers +   `locale` envelope field + `message_key` + `message_params`) is   stable and exercised; the **catalog** of translated `message`   strings is en-GB-only at runtime today. Additional locales (e.g.   `pt-PT`) will be advertised by name when their catalogs ship —   the request/response carrier shape does NOT change when a new   locale lands. Treat unrequested locales as \"machine-code +   `message_key` path is committed; localised `message` prose is   not\" until this prose enumerates them by name. - **Request:** `Accept-Language` header per RFC 9110 §12.5.4 (q-value   negotiation supported). The server selects the best-match locale   from its supported list; falls back to `en-GB` when no match —   which, until additional catalogs land, is every non-`en-GB`   `Accept-Language`. - **Response:** `Content-Language: <locale>` echo on every localised   response; `Vary: Accept-Language` on every response (CDN/cache   correctness — different `Accept-Language` requests produce   different responses). `Vary` is emitted unconditionally so the   header contract does not flip when a second locale ships. - **Fallback locale:** `en-GB` (also the canonical locale for   `message_key` translations and English `message` prose). - **SDK guidance:** switch on `error` (machine code) for typed   error branches; surface `message_key` to client-side i18n   catalogs (SDK companion work tracked at X19, cross-repo);   display `message` for end-user UI; **never parse `message` for   control flow** — it changes per locale.  Carrier shape lives on `ErrorEnvelope` (envelope-level optional `message_key` + `message` + `locale` + `message_params`) and `ValidationErrorEnvelope` (also per-`details[]` entry). Existing 402 / 403 / 422 envelopes (`BalanceExhaustedResponse`, `FeatureNotAvailableResponse`, `FeatureTierRestrictedResponse`, `WorkflowPausedDetail`) inherit the convention.  **Upload thresholds (per tickets [u0ar7Yye](https://trello.com/c/u0ar7Yye) + [58nBQLWQ](https://trello.com/c/58nBQLWQ)).** Canonical upload constants (single-shot cap, multipart chunk size, multipart concurrency default, multipart first-chunk size) live on the `UploadThresholds` schema with `const:`-pinned values. SDK generators emit these as typed binding constants so frontend / API / SDKs reference one source of truth instead of hardcoding magic numbers. A runtime `GET /api/uploads/limits` endpoint for dynamic discovery (per-tier / per-environment overrides) is a deferred follow-up.
 *
 * The version of the OpenAPI document: 2.170.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.21.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Gisl\Generated\OpenApi\Model;

use \ArrayAccess;
use \Gisl\Generated\OpenApi\ObjectSerializer;

/**
 * MetadataResponse Class Doc Comment
 *
 * @category Class
 * @description File metadata. Fields vary by MIME type. Common fields are always present; type-specific fields (dimensions, exif, duration, etc.) are included when available for the file type.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MetadataResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'MetadataResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'file_id' => 'string',
        'original_name' => 'string',
        'mime_type' => 'string',
        'size_bytes' => 'int',
        'created_at' => '\DateTime',
        'dimensions' => '\Gisl\Generated\OpenApi\Model\MetadataResponseDimensions',
        'color_space' => 'string',
        'dpi' => 'int',
        'has_alpha' => 'bool',
        'exif' => '\Gisl\Generated\OpenApi\Model\MetadataResponseExif',
        'dominant_colors' => 'string[]',
        'duration' => 'float',
        'codec' => 'string',
        'fps' => 'float',
        'audio_codec' => 'string',
        'bitrate' => 'int',
        'channels' => 'int',
        'sample_rate' => 'int',
        'page_count' => 'int'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'file_id' => 'uuid',
        'original_name' => null,
        'mime_type' => null,
        'size_bytes' => 'int64',
        'created_at' => 'date-time',
        'dimensions' => null,
        'color_space' => null,
        'dpi' => null,
        'has_alpha' => null,
        'exif' => null,
        'dominant_colors' => null,
        'duration' => 'double',
        'codec' => null,
        'fps' => 'double',
        'audio_codec' => null,
        'bitrate' => null,
        'channels' => null,
        'sample_rate' => null,
        'page_count' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'file_id' => false,
        'original_name' => false,
        'mime_type' => false,
        'size_bytes' => false,
        'created_at' => false,
        'dimensions' => false,
        'color_space' => false,
        'dpi' => false,
        'has_alpha' => false,
        'exif' => false,
        'dominant_colors' => false,
        'duration' => false,
        'codec' => false,
        'fps' => false,
        'audio_codec' => false,
        'bitrate' => false,
        'channels' => false,
        'sample_rate' => false,
        'page_count' => false
    ];

    /**
     * If a nullable field gets set to null, insert it here
     *
     * @var boolean[]
     */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'file_id' => 'file_id',
        'original_name' => 'original_name',
        'mime_type' => 'mime_type',
        'size_bytes' => 'size_bytes',
        'created_at' => 'created_at',
        'dimensions' => 'dimensions',
        'color_space' => 'color_space',
        'dpi' => 'dpi',
        'has_alpha' => 'has_alpha',
        'exif' => 'exif',
        'dominant_colors' => 'dominant_colors',
        'duration' => 'duration',
        'codec' => 'codec',
        'fps' => 'fps',
        'audio_codec' => 'audio_codec',
        'bitrate' => 'bitrate',
        'channels' => 'channels',
        'sample_rate' => 'sample_rate',
        'page_count' => 'page_count'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'file_id' => 'setFileId',
        'original_name' => 'setOriginalName',
        'mime_type' => 'setMimeType',
        'size_bytes' => 'setSizeBytes',
        'created_at' => 'setCreatedAt',
        'dimensions' => 'setDimensions',
        'color_space' => 'setColorSpace',
        'dpi' => 'setDpi',
        'has_alpha' => 'setHasAlpha',
        'exif' => 'setExif',
        'dominant_colors' => 'setDominantColors',
        'duration' => 'setDuration',
        'codec' => 'setCodec',
        'fps' => 'setFps',
        'audio_codec' => 'setAudioCodec',
        'bitrate' => 'setBitrate',
        'channels' => 'setChannels',
        'sample_rate' => 'setSampleRate',
        'page_count' => 'setPageCount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'file_id' => 'getFileId',
        'original_name' => 'getOriginalName',
        'mime_type' => 'getMimeType',
        'size_bytes' => 'getSizeBytes',
        'created_at' => 'getCreatedAt',
        'dimensions' => 'getDimensions',
        'color_space' => 'getColorSpace',
        'dpi' => 'getDpi',
        'has_alpha' => 'getHasAlpha',
        'exif' => 'getExif',
        'dominant_colors' => 'getDominantColors',
        'duration' => 'getDuration',
        'codec' => 'getCodec',
        'fps' => 'getFps',
        'audio_codec' => 'getAudioCodec',
        'bitrate' => 'getBitrate',
        'channels' => 'getChannels',
        'sample_rate' => 'getSampleRate',
        'page_count' => 'getPageCount'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('file_id', $data ?? [], null);
        $this->setIfExists('original_name', $data ?? [], null);
        $this->setIfExists('mime_type', $data ?? [], null);
        $this->setIfExists('size_bytes', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('dimensions', $data ?? [], null);
        $this->setIfExists('color_space', $data ?? [], null);
        $this->setIfExists('dpi', $data ?? [], null);
        $this->setIfExists('has_alpha', $data ?? [], null);
        $this->setIfExists('exif', $data ?? [], null);
        $this->setIfExists('dominant_colors', $data ?? [], null);
        $this->setIfExists('duration', $data ?? [], null);
        $this->setIfExists('codec', $data ?? [], null);
        $this->setIfExists('fps', $data ?? [], null);
        $this->setIfExists('audio_codec', $data ?? [], null);
        $this->setIfExists('bitrate', $data ?? [], null);
        $this->setIfExists('channels', $data ?? [], null);
        $this->setIfExists('sample_rate', $data ?? [], null);
        $this->setIfExists('page_count', $data ?? [], null);
    }

    /**
     * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
     * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
     * $this->openAPINullablesSetToNull array
     *
     * @param string $variableName
     * @param array  $fields
     * @param mixed  $defaultValue
     */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['file_id'] === null) {
            $invalidProperties[] = "'file_id' can't be null";
        }
        if (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['file_id'])) {
            $invalidProperties[] = "invalid value for 'file_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['original_name'] === null) {
            $invalidProperties[] = "'original_name' can't be null";
        }
        if ($this->container['mime_type'] === null) {
            $invalidProperties[] = "'mime_type' can't be null";
        }
        if ($this->container['size_bytes'] === null) {
            $invalidProperties[] = "'size_bytes' can't be null";
        }
        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets file_id
     *
     * @return string
     */
    public function getFileId()
    {
        return $this->container['file_id'];
    }

    /**
     * Sets file_id
     *
     * @param string $file_id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setFileId($file_id)
    {
        if (is_null($file_id)) {
            throw new \InvalidArgumentException('non-nullable file_id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($file_id)))) {
            throw new \InvalidArgumentException("invalid value for \$file_id when calling MetadataResponse., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['file_id'] = $file_id;

        return $this;
    }

    /**
     * Gets original_name
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->container['original_name'];
    }

    /**
     * Sets original_name
     *
     * @param string $original_name original_name
     *
     * @return self
     */
    public function setOriginalName($original_name)
    {
        if (is_null($original_name)) {
            throw new \InvalidArgumentException('non-nullable original_name cannot be null');
        }
        $this->container['original_name'] = $original_name;

        return $this;
    }

    /**
     * Gets mime_type
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->container['mime_type'];
    }

    /**
     * Sets mime_type
     *
     * @param string $mime_type mime_type
     *
     * @return self
     */
    public function setMimeType($mime_type)
    {
        if (is_null($mime_type)) {
            throw new \InvalidArgumentException('non-nullable mime_type cannot be null');
        }
        $this->container['mime_type'] = $mime_type;

        return $this;
    }

    /**
     * Gets size_bytes
     *
     * @return int
     */
    public function getSizeBytes()
    {
        return $this->container['size_bytes'];
    }

    /**
     * Sets size_bytes
     *
     * @param int $size_bytes size_bytes
     *
     * @return self
     */
    public function setSizeBytes($size_bytes)
    {
        if (is_null($size_bytes)) {
            throw new \InvalidArgumentException('non-nullable size_bytes cannot be null');
        }
        $this->container['size_bytes'] = $size_bytes;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param \DateTime $created_at ISO-8601 timestamp at which the upload row was committed to the database. The API always emits this field; spec catches up to behaviour shipping since `UploadMetadataController.php:52`. Per ticket [CCpf6CD7](https://trello.com/c/CCpf6CD7).
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        if (is_null($created_at)) {
            throw new \InvalidArgumentException('non-nullable created_at cannot be null');
        }
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets dimensions
     *
     * @return \Gisl\Generated\OpenApi\Model\MetadataResponseDimensions|null
     */
    public function getDimensions()
    {
        return $this->container['dimensions'];
    }

    /**
     * Sets dimensions
     *
     * @param \Gisl\Generated\OpenApi\Model\MetadataResponseDimensions|null $dimensions dimensions
     *
     * @return self
     */
    public function setDimensions($dimensions)
    {
        if (is_null($dimensions)) {
            throw new \InvalidArgumentException('non-nullable dimensions cannot be null');
        }
        $this->container['dimensions'] = $dimensions;

        return $this;
    }

    /**
     * Gets color_space
     *
     * @return string|null
     */
    public function getColorSpace()
    {
        return $this->container['color_space'];
    }

    /**
     * Sets color_space
     *
     * @param string|null $color_space Color space (images)
     *
     * @return self
     */
    public function setColorSpace($color_space)
    {
        if (is_null($color_space)) {
            throw new \InvalidArgumentException('non-nullable color_space cannot be null');
        }
        $this->container['color_space'] = $color_space;

        return $this;
    }

    /**
     * Gets dpi
     *
     * @return int|null
     */
    public function getDpi()
    {
        return $this->container['dpi'];
    }

    /**
     * Sets dpi
     *
     * @param int|null $dpi Dots per inch (images, PDF)
     *
     * @return self
     */
    public function setDpi($dpi)
    {
        if (is_null($dpi)) {
            throw new \InvalidArgumentException('non-nullable dpi cannot be null');
        }
        $this->container['dpi'] = $dpi;

        return $this;
    }

    /**
     * Gets has_alpha
     *
     * @return bool|null
     */
    public function getHasAlpha()
    {
        return $this->container['has_alpha'];
    }

    /**
     * Sets has_alpha
     *
     * @param bool|null $has_alpha Whether the image has an alpha channel (images)
     *
     * @return self
     */
    public function setHasAlpha($has_alpha)
    {
        if (is_null($has_alpha)) {
            throw new \InvalidArgumentException('non-nullable has_alpha cannot be null');
        }
        $this->container['has_alpha'] = $has_alpha;

        return $this;
    }

    /**
     * Gets exif
     *
     * @return \Gisl\Generated\OpenApi\Model\MetadataResponseExif|null
     */
    public function getExif()
    {
        return $this->container['exif'];
    }

    /**
     * Sets exif
     *
     * @param \Gisl\Generated\OpenApi\Model\MetadataResponseExif|null $exif exif
     *
     * @return self
     */
    public function setExif($exif)
    {
        if (is_null($exif)) {
            throw new \InvalidArgumentException('non-nullable exif cannot be null');
        }
        $this->container['exif'] = $exif;

        return $this;
    }

    /**
     * Gets dominant_colors
     *
     * @return string[]|null
     */
    public function getDominantColors()
    {
        return $this->container['dominant_colors'];
    }

    /**
     * Sets dominant_colors
     *
     * @param string[]|null $dominant_colors Dominant colors as hex strings (images)
     *
     * @return self
     */
    public function setDominantColors($dominant_colors)
    {
        if (is_null($dominant_colors)) {
            throw new \InvalidArgumentException('non-nullable dominant_colors cannot be null');
        }
        $this->container['dominant_colors'] = $dominant_colors;

        return $this;
    }

    /**
     * Gets duration
     *
     * @return float|null
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param float|null $duration Duration in seconds (video, audio)
     *
     * @return self
     */
    public function setDuration($duration)
    {
        if (is_null($duration)) {
            throw new \InvalidArgumentException('non-nullable duration cannot be null');
        }
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets codec
     *
     * @return string|null
     */
    public function getCodec()
    {
        return $this->container['codec'];
    }

    /**
     * Sets codec
     *
     * @param string|null $codec Video/audio codec
     *
     * @return self
     */
    public function setCodec($codec)
    {
        if (is_null($codec)) {
            throw new \InvalidArgumentException('non-nullable codec cannot be null');
        }
        $this->container['codec'] = $codec;

        return $this;
    }

    /**
     * Gets fps
     *
     * @return float|null
     */
    public function getFps()
    {
        return $this->container['fps'];
    }

    /**
     * Sets fps
     *
     * @param float|null $fps Frames per second (video)
     *
     * @return self
     */
    public function setFps($fps)
    {
        if (is_null($fps)) {
            throw new \InvalidArgumentException('non-nullable fps cannot be null');
        }
        $this->container['fps'] = $fps;

        return $this;
    }

    /**
     * Gets audio_codec
     *
     * @return string|null
     */
    public function getAudioCodec()
    {
        return $this->container['audio_codec'];
    }

    /**
     * Sets audio_codec
     *
     * @param string|null $audio_codec Audio codec (video)
     *
     * @return self
     */
    public function setAudioCodec($audio_codec)
    {
        if (is_null($audio_codec)) {
            throw new \InvalidArgumentException('non-nullable audio_codec cannot be null');
        }
        $this->container['audio_codec'] = $audio_codec;

        return $this;
    }

    /**
     * Gets bitrate
     *
     * @return int|null
     */
    public function getBitrate()
    {
        return $this->container['bitrate'];
    }

    /**
     * Sets bitrate
     *
     * @param int|null $bitrate Bitrate in bps (video, audio)
     *
     * @return self
     */
    public function setBitrate($bitrate)
    {
        if (is_null($bitrate)) {
            throw new \InvalidArgumentException('non-nullable bitrate cannot be null');
        }
        $this->container['bitrate'] = $bitrate;

        return $this;
    }

    /**
     * Gets channels
     *
     * @return int|null
     */
    public function getChannels()
    {
        return $this->container['channels'];
    }

    /**
     * Sets channels
     *
     * @param int|null $channels Audio channels (audio)
     *
     * @return self
     */
    public function setChannels($channels)
    {
        if (is_null($channels)) {
            throw new \InvalidArgumentException('non-nullable channels cannot be null');
        }
        $this->container['channels'] = $channels;

        return $this;
    }

    /**
     * Gets sample_rate
     *
     * @return int|null
     */
    public function getSampleRate()
    {
        return $this->container['sample_rate'];
    }

    /**
     * Sets sample_rate
     *
     * @param int|null $sample_rate Sample rate in Hz (audio)
     *
     * @return self
     */
    public function setSampleRate($sample_rate)
    {
        if (is_null($sample_rate)) {
            throw new \InvalidArgumentException('non-nullable sample_rate cannot be null');
        }
        $this->container['sample_rate'] = $sample_rate;

        return $this;
    }

    /**
     * Gets page_count
     *
     * @return int|null
     */
    public function getPageCount()
    {
        return $this->container['page_count'];
    }

    /**
     * Sets page_count
     *
     * @param int|null $page_count Number of pages (documents)
     *
     * @return self
     */
    public function setPageCount($page_count)
    {
        if (is_null($page_count)) {
            throw new \InvalidArgumentException('non-nullable page_count cannot be null');
        }
        $this->container['page_count'] = $page_count;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer|string $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


