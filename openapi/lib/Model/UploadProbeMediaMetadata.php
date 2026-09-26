<?php
/**
 * UploadProbeMediaMetadata
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
 * REST API for the GISL (Give It Smaller) file compression and processing service.  **Architecture:** - Upload files to get a `file_id` - Create workflows referencing uploaded files with operations (compress, thumbnail, image_watermark, text_watermark, merge, archive, convert, custom_luma, audio_overlay, audio_watermark) - Poll status, stream SSE events, or receive webhook callbacks - Download results per operation output  **Response envelope:** All mutation and query endpoints return `{ success: true, data: {...} }` on success and `{ success: false, error: \"...\", details: [...] }` on failure. Exceptions: `GET /api/operations/schema` returns raw JSON (per-tier private caching with ETag revalidation per ADR-0002 + I3), health probes return flat objects, and `POST /api/contact` returns 204 with no body.  **Availability metadata.** This spec uses the `x-availability` vendor extension as **decorative documentation only**. Per [ADR-0001](../docs/decisions/0001-contract-first-availability.md) §1.5, the runtime endpoint `GET /api/operations/schema` (ticket I3) is the authoritative source; the sidecar `availability.json` (ticket I3b) is the authoritative companion (generated, never hand-edited; CI cross-checks runtime ⇄ sidecar). SDKs MUST NOT depend on `x-availability` reaching generated code — code-generators that surface vendor extensions may emit it as documentation, but consumers read availability from the runtime endpoint, not from the generated bindings.  The 5-value vocabulary (`stable | beta | experimental | planned | deprecated`) is defined in the `AvailabilityValue` schema. See `schemas/FORMAT.md` §Availability Taxonomy for the operational rules (parser obligation: absent = stable; per-enum-value granularity is the `per_value_availability` primitive landed via ticket I17).  **Free-text string fields: `x-string-vocabulary` (ticket [`Q79yjcFF`](https://trello.com/c/Q79yjcFF)).** A `type: string` field with no `enum` that names example values says, as data, what a client may do with them (the same marker is used in the AsyncAPI document): - `open` — a vocabulary that grows. Each published value keeps its   meaning, the SET is not closed: switch on the values you know and   handle an unknown one as the generic case (e.g. `ErrorEnvelope.error`). - `advisory` — explanatory text. Display or log it; **never switch on   it** (e.g. `SseWorkflowTerminalData.reason`). - `none` — not a vocabulary at all (an expression or an identifier,   e.g. `OptionSchema.pattern`). A field whose description hedges with \"common values\" or \"free-form\" must carry the marker; a test enforces it.  **Localisation (per ticket [I26](https://trello.com/c/rcnqwgI4)).**  Error responses + paused/blocked workflow statuses carry a localised human-readable `message` alongside a stable, never-localised `message_key`. Machine-readable fields (`error`, enum values, status codes) stay canonical English.  - **Currently committed locales:** `en-GB` only (per ticket   [`4GKyuYo6`](https://trello.com/c/4GKyuYo6)). The I26 carrier   shape (`Accept-Language` + `Content-Language` + `Vary` headers +   `locale` envelope field + `message_key` + `message_params`) is   stable and exercised; the **catalog** of translated `message`   strings is en-GB-only at runtime today. Additional locales (e.g.   `pt-PT`) will be advertised by name when their catalogs ship —   the request/response carrier shape does NOT change when a new   locale lands. Treat unrequested locales as \"machine-code +   `message_key` path is committed; localised `message` prose is   not\" until this prose enumerates them by name. - **Request:** `Accept-Language` header per RFC 9110 §12.5.4 (q-value   negotiation supported). The server selects the best-match locale   from its supported list; falls back to `en-GB` when no match —   which, until additional catalogs land, is every non-`en-GB`   `Accept-Language`. - **Response:** `Content-Language: <locale>` echo on every localised   response; `Vary: Accept-Language` on every response (CDN/cache   correctness — different `Accept-Language` requests produce   different responses). `Vary` is emitted unconditionally so the   header contract does not flip when a second locale ships. - **Fallback locale:** `en-GB` (also the canonical locale for   `message_key` translations and English `message` prose). - **SDK guidance:** switch on `error` (machine code) for typed   error branches; surface `message_key` to client-side i18n   catalogs (SDK companion work tracked at X19, cross-repo);   display `message` for end-user UI; **never parse `message` for   control flow** — it changes per locale.  Carrier shape lives on `ErrorEnvelope` (envelope-level optional `message_key` + `message` + `locale` + `message_params`) and `ValidationErrorEnvelope` (also per-`details[]` entry). Existing 402 / 403 / 422 envelopes (`BalanceExhaustedResponse`, `FeatureNotAvailableResponse`, `FeatureTierRestrictedResponse`, `WorkflowPausedDetail`) inherit the convention.  **Upload thresholds (per tickets [u0ar7Yye](https://trello.com/c/u0ar7Yye) + [58nBQLWQ](https://trello.com/c/58nBQLWQ)).** Canonical upload constants (single-shot cap, multipart chunk size, multipart concurrency default, multipart first-chunk size) live on the `UploadThresholds` schema with `const:`-pinned values. SDK generators emit these as typed binding constants so frontend / API / SDKs reference one source of truth instead of hardcoding magic numbers. A runtime `GET /api/uploads/limits` endpoint for dynamic discovery (per-tier / per-environment overrides) is a deferred follow-up.
 *
 * The version of the OpenAPI document: 2.215.0
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
 * UploadProbeMediaMetadata Class Doc Comment
 *
 * @category Class
 * @description Probe-extracted media metadata. Fields populated according to the file&#39;s MIME type and what the prober could read; absent fields are NOT errors — they reflect \&quot;this metadata is not applicable / not extractable\&quot; rather than \&quot;this metadata failed validation\&quot;. &#x60;probed_at&#x60; is always present.  Schema covers the **union** of fields needed by the API&#39;s &#x60;MetadataResponse&#x60; projection across video / audio / document inputs (per the M2 Epic re-scope — [&#x60;SrHwuvIl&#x60;](https://trello.com/c/SrHwuvIl) — which makes this probe Lambda the universal non-image metadata source feeding &#x60;rich_metadata&#x60;). The Lambda extractor only populates fields it can derive from the actual container; unrelated fields are simply omitted.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class UploadProbeMediaMetadata implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'UploadProbeMediaMetadata';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'duration_seconds' => 'int',
        'width' => 'int',
        'height' => 'int',
        'codec' => 'string',
        'audio_codec' => 'string',
        'container' => 'string',
        'fps' => 'float',
        'bitrate_bps' => 'int',
        'audio_layout' => 'string',
        'channels' => 'int',
        'sample_rate_hz' => 'int',
        'page_count' => 'int',
        'dpi' => 'int',
        'video_stream_count' => 'int',
        'audio_stream_count' => 'int',
        'other_stream_count' => 'int',
        'stream_order' => 'string[]',
        'r_frame_rate' => 'string',
        'avg_frame_rate' => 'string',
        'pix_fmt' => 'string',
        'sar' => 'string',
        'video_time_base' => 'string',
        'audio_time_base' => 'string',
        'codec_tag' => 'string',
        'profile' => 'string',
        'sample_fmt' => 'string',
        'probed_at' => '\DateTime'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'duration_seconds' => null,
        'width' => 'int64',
        'height' => 'int64',
        'codec' => null,
        'audio_codec' => null,
        'container' => null,
        'fps' => null,
        'bitrate_bps' => 'int64',
        'audio_layout' => null,
        'channels' => null,
        'sample_rate_hz' => null,
        'page_count' => null,
        'dpi' => null,
        'video_stream_count' => null,
        'audio_stream_count' => null,
        'other_stream_count' => null,
        'stream_order' => null,
        'r_frame_rate' => null,
        'avg_frame_rate' => null,
        'pix_fmt' => null,
        'sar' => null,
        'video_time_base' => null,
        'audio_time_base' => null,
        'codec_tag' => null,
        'profile' => null,
        'sample_fmt' => null,
        'probed_at' => 'date-time'
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'duration_seconds' => false,
        'width' => false,
        'height' => false,
        'codec' => false,
        'audio_codec' => false,
        'container' => false,
        'fps' => false,
        'bitrate_bps' => false,
        'audio_layout' => false,
        'channels' => false,
        'sample_rate_hz' => false,
        'page_count' => false,
        'dpi' => false,
        'video_stream_count' => false,
        'audio_stream_count' => false,
        'other_stream_count' => false,
        'stream_order' => false,
        'r_frame_rate' => false,
        'avg_frame_rate' => false,
        'pix_fmt' => false,
        'sar' => false,
        'video_time_base' => false,
        'audio_time_base' => false,
        'codec_tag' => false,
        'profile' => false,
        'sample_fmt' => false,
        'probed_at' => false
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
        'duration_seconds' => 'duration_seconds',
        'width' => 'width',
        'height' => 'height',
        'codec' => 'codec',
        'audio_codec' => 'audio_codec',
        'container' => 'container',
        'fps' => 'fps',
        'bitrate_bps' => 'bitrate_bps',
        'audio_layout' => 'audio_layout',
        'channels' => 'channels',
        'sample_rate_hz' => 'sample_rate_hz',
        'page_count' => 'page_count',
        'dpi' => 'dpi',
        'video_stream_count' => 'video_stream_count',
        'audio_stream_count' => 'audio_stream_count',
        'other_stream_count' => 'other_stream_count',
        'stream_order' => 'stream_order',
        'r_frame_rate' => 'r_frame_rate',
        'avg_frame_rate' => 'avg_frame_rate',
        'pix_fmt' => 'pix_fmt',
        'sar' => 'sar',
        'video_time_base' => 'video_time_base',
        'audio_time_base' => 'audio_time_base',
        'codec_tag' => 'codec_tag',
        'profile' => 'profile',
        'sample_fmt' => 'sample_fmt',
        'probed_at' => 'probed_at'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'duration_seconds' => 'setDurationSeconds',
        'width' => 'setWidth',
        'height' => 'setHeight',
        'codec' => 'setCodec',
        'audio_codec' => 'setAudioCodec',
        'container' => 'setContainer',
        'fps' => 'setFps',
        'bitrate_bps' => 'setBitrateBps',
        'audio_layout' => 'setAudioLayout',
        'channels' => 'setChannels',
        'sample_rate_hz' => 'setSampleRateHz',
        'page_count' => 'setPageCount',
        'dpi' => 'setDpi',
        'video_stream_count' => 'setVideoStreamCount',
        'audio_stream_count' => 'setAudioStreamCount',
        'other_stream_count' => 'setOtherStreamCount',
        'stream_order' => 'setStreamOrder',
        'r_frame_rate' => 'setRFrameRate',
        'avg_frame_rate' => 'setAvgFrameRate',
        'pix_fmt' => 'setPixFmt',
        'sar' => 'setSar',
        'video_time_base' => 'setVideoTimeBase',
        'audio_time_base' => 'setAudioTimeBase',
        'codec_tag' => 'setCodecTag',
        'profile' => 'setProfile',
        'sample_fmt' => 'setSampleFmt',
        'probed_at' => 'setProbedAt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'duration_seconds' => 'getDurationSeconds',
        'width' => 'getWidth',
        'height' => 'getHeight',
        'codec' => 'getCodec',
        'audio_codec' => 'getAudioCodec',
        'container' => 'getContainer',
        'fps' => 'getFps',
        'bitrate_bps' => 'getBitrateBps',
        'audio_layout' => 'getAudioLayout',
        'channels' => 'getChannels',
        'sample_rate_hz' => 'getSampleRateHz',
        'page_count' => 'getPageCount',
        'dpi' => 'getDpi',
        'video_stream_count' => 'getVideoStreamCount',
        'audio_stream_count' => 'getAudioStreamCount',
        'other_stream_count' => 'getOtherStreamCount',
        'stream_order' => 'getStreamOrder',
        'r_frame_rate' => 'getRFrameRate',
        'avg_frame_rate' => 'getAvgFrameRate',
        'pix_fmt' => 'getPixFmt',
        'sar' => 'getSar',
        'video_time_base' => 'getVideoTimeBase',
        'audio_time_base' => 'getAudioTimeBase',
        'codec_tag' => 'getCodecTag',
        'profile' => 'getProfile',
        'sample_fmt' => 'getSampleFmt',
        'probed_at' => 'getProbedAt'
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

    public const STREAM_ORDER_VIDEO = 'video';
    public const STREAM_ORDER_AUDIO = 'audio';
    public const STREAM_ORDER_OTHER = 'other';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStreamOrderAllowableValues()
    {
        return [
            self::STREAM_ORDER_VIDEO,
            self::STREAM_ORDER_AUDIO,
            self::STREAM_ORDER_OTHER,
        ];
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
        $this->setIfExists('duration_seconds', $data ?? [], null);
        $this->setIfExists('width', $data ?? [], null);
        $this->setIfExists('height', $data ?? [], null);
        $this->setIfExists('codec', $data ?? [], null);
        $this->setIfExists('audio_codec', $data ?? [], null);
        $this->setIfExists('container', $data ?? [], null);
        $this->setIfExists('fps', $data ?? [], null);
        $this->setIfExists('bitrate_bps', $data ?? [], null);
        $this->setIfExists('audio_layout', $data ?? [], null);
        $this->setIfExists('channels', $data ?? [], null);
        $this->setIfExists('sample_rate_hz', $data ?? [], null);
        $this->setIfExists('page_count', $data ?? [], null);
        $this->setIfExists('dpi', $data ?? [], null);
        $this->setIfExists('video_stream_count', $data ?? [], null);
        $this->setIfExists('audio_stream_count', $data ?? [], null);
        $this->setIfExists('other_stream_count', $data ?? [], null);
        $this->setIfExists('stream_order', $data ?? [], null);
        $this->setIfExists('r_frame_rate', $data ?? [], null);
        $this->setIfExists('avg_frame_rate', $data ?? [], null);
        $this->setIfExists('pix_fmt', $data ?? [], null);
        $this->setIfExists('sar', $data ?? [], null);
        $this->setIfExists('video_time_base', $data ?? [], null);
        $this->setIfExists('audio_time_base', $data ?? [], null);
        $this->setIfExists('codec_tag', $data ?? [], null);
        $this->setIfExists('profile', $data ?? [], null);
        $this->setIfExists('sample_fmt', $data ?? [], null);
        $this->setIfExists('probed_at', $data ?? [], null);
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

        if (!is_null($this->container['duration_seconds']) && ($this->container['duration_seconds'] < 0)) {
            $invalidProperties[] = "invalid value for 'duration_seconds', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['width']) && ($this->container['width'] < 1)) {
            $invalidProperties[] = "invalid value for 'width', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['height']) && ($this->container['height'] < 1)) {
            $invalidProperties[] = "invalid value for 'height', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['fps']) && ($this->container['fps'] < 0)) {
            $invalidProperties[] = "invalid value for 'fps', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['bitrate_bps']) && ($this->container['bitrate_bps'] < 0)) {
            $invalidProperties[] = "invalid value for 'bitrate_bps', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['channels']) && ($this->container['channels'] < 1)) {
            $invalidProperties[] = "invalid value for 'channels', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['sample_rate_hz']) && ($this->container['sample_rate_hz'] < 1)) {
            $invalidProperties[] = "invalid value for 'sample_rate_hz', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['page_count']) && ($this->container['page_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'page_count', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['dpi']) && ($this->container['dpi'] < 1)) {
            $invalidProperties[] = "invalid value for 'dpi', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['video_stream_count']) && ($this->container['video_stream_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'video_stream_count', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['audio_stream_count']) && ($this->container['audio_stream_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'audio_stream_count', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['other_stream_count']) && ($this->container['other_stream_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'other_stream_count', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['r_frame_rate']) && !preg_match("/^[0-9]+\/[0-9]+$/", $this->container['r_frame_rate'])) {
            $invalidProperties[] = "invalid value for 'r_frame_rate', must be conform to the pattern /^[0-9]+\/[0-9]+$/.";
        }

        if (!is_null($this->container['avg_frame_rate']) && !preg_match("/^[0-9]+\/[0-9]+$/", $this->container['avg_frame_rate'])) {
            $invalidProperties[] = "invalid value for 'avg_frame_rate', must be conform to the pattern /^[0-9]+\/[0-9]+$/.";
        }

        if (!is_null($this->container['sar']) && !preg_match("/^[0-9]+:[0-9]+$/", $this->container['sar'])) {
            $invalidProperties[] = "invalid value for 'sar', must be conform to the pattern /^[0-9]+:[0-9]+$/.";
        }

        if (!is_null($this->container['video_time_base']) && !preg_match("/^[0-9]+\/[0-9]+$/", $this->container['video_time_base'])) {
            $invalidProperties[] = "invalid value for 'video_time_base', must be conform to the pattern /^[0-9]+\/[0-9]+$/.";
        }

        if (!is_null($this->container['audio_time_base']) && !preg_match("/^[0-9]+\/[0-9]+$/", $this->container['audio_time_base'])) {
            $invalidProperties[] = "invalid value for 'audio_time_base', must be conform to the pattern /^[0-9]+\/[0-9]+$/.";
        }

        if ($this->container['probed_at'] === null) {
            $invalidProperties[] = "'probed_at' can't be null";
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
     * Gets duration_seconds
     *
     * @return int|null
     */
    public function getDurationSeconds()
    {
        return $this->container['duration_seconds'];
    }

    /**
     * Sets duration_seconds
     *
     * @param int|null $duration_seconds Container-reported duration (audio + video).
     *
     * @return self
     */
    public function setDurationSeconds($duration_seconds)
    {
        if (is_null($duration_seconds)) {
            throw new \InvalidArgumentException('non-nullable duration_seconds cannot be null');
        }

        if (($duration_seconds < 0)) {
            throw new \InvalidArgumentException('invalid value for $duration_seconds when calling UploadProbeMediaMetadata., must be bigger than or equal to 0.');
        }

        $this->container['duration_seconds'] = $duration_seconds;

        return $this;
    }

    /**
     * Gets width
     *
     * @return int|null
     */
    public function getWidth()
    {
        return $this->container['width'];
    }

    /**
     * Sets width
     *
     * @param int|null $width Pixel width (image + video; best-effort document). Declared `int64` so Rust SDK generators emit `i64` instead of the default `i32`; `i32` is fine for everything ffmpeg/libcaesium handles today but the format hint keeps the door open for scientific / RAW imagery without future SDK churn (per ticket [`0sTmbUsc`](https://trello.com/c/0sTmbUsc)).
     *
     * @return self
     */
    public function setWidth($width)
    {
        if (is_null($width)) {
            throw new \InvalidArgumentException('non-nullable width cannot be null');
        }

        if (($width < 1)) {
            throw new \InvalidArgumentException('invalid value for $width when calling UploadProbeMediaMetadata., must be bigger than or equal to 1.');
        }

        $this->container['width'] = $width;

        return $this;
    }

    /**
     * Gets height
     *
     * @return int|null
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /**
     * Sets height
     *
     * @param int|null $height Pixel height (image + video; best-effort document). See `width` for the `format: int64` rationale.
     *
     * @return self
     */
    public function setHeight($height)
    {
        if (is_null($height)) {
            throw new \InvalidArgumentException('non-nullable height cannot be null');
        }

        if (($height < 1)) {
            throw new \InvalidArgumentException('invalid value for $height when calling UploadProbeMediaMetadata., must be bigger than or equal to 1.');
        }

        $this->container['height'] = $height;

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
     * @param string|null $codec Primary codec identifier as reported by the prober. For video inputs this is the **video** codec; for audio-only inputs this is the audio codec. For video files with audio tracks, the audio codec is reported separately as `audio_codec`. Examples: `h264`, `h265`, `vp9`, `av1`, `aac`, `opus`, `mp3`. Not constrained to an enum — codec strings evolve with FFmpeg releases (per ADR-0007 FFmpeg pin) and SDKs should string-match.
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
     * @param string|null $audio_codec Audio codec for video files that carry an audio track. Distinct from `codec` (which is the video codec for video inputs). Absent for video-only / silent video inputs and for audio-only inputs (audio-only inputs put their codec under `codec`).
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
     * Gets container
     *
     * @return string|null
     */
    public function getContainer()
    {
        return $this->container['container'];
    }

    /**
     * Sets container
     *
     * @param string|null $container Container format. Examples: `mp4`, `webm`, `mov`, `mkv`, `mp3`, `wav`, `flac`. Not constrained to an enum.
     *
     * @return self
     */
    public function setContainer($container)
    {
        if (is_null($container)) {
            throw new \InvalidArgumentException('non-nullable container cannot be null');
        }
        $this->container['container'] = $container;

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
     * @param float|null $fps Container-reported frame rate (video only). Number, not integer — frame rates are commonly fractional (e.g. `29.97`, `23.976`).
     *
     * @return self
     */
    public function setFps($fps)
    {
        if (is_null($fps)) {
            throw new \InvalidArgumentException('non-nullable fps cannot be null');
        }

        if (($fps < 0)) {
            throw new \InvalidArgumentException('invalid value for $fps when calling UploadProbeMediaMetadata., must be bigger than or equal to 0.');
        }

        $this->container['fps'] = $fps;

        return $this;
    }

    /**
     * Gets bitrate_bps
     *
     * @return int|null
     */
    public function getBitrateBps()
    {
        return $this->container['bitrate_bps'];
    }

    /**
     * Sets bitrate_bps
     *
     * @param int|null $bitrate_bps Overall stream bitrate, **bits per second**. Units in the field name, mirroring `duration_seconds`, so SDKs avoid the kbps-vs-bps guessing trap. Container-reported for video + audio. Declared `int64` so Rust SDK generators emit `i64` instead of `i32`; `i32` caps at ~2.1 Gbps which is tight for future 4K/8K/RAW workloads (per ticket [`0sTmbUsc`](https://trello.com/c/0sTmbUsc)).
     *
     * @return self
     */
    public function setBitrateBps($bitrate_bps)
    {
        if (is_null($bitrate_bps)) {
            throw new \InvalidArgumentException('non-nullable bitrate_bps cannot be null');
        }

        if (($bitrate_bps < 0)) {
            throw new \InvalidArgumentException('invalid value for $bitrate_bps when calling UploadProbeMediaMetadata., must be bigger than or equal to 0.');
        }

        $this->container['bitrate_bps'] = $bitrate_bps;

        return $this;
    }

    /**
     * Gets audio_layout
     *
     * @return string|null
     */
    public function getAudioLayout()
    {
        return $this->container['audio_layout'];
    }

    /**
     * Sets audio_layout
     *
     * @param string|null $audio_layout Channel layout, human-display form. Examples: `mono`, `stereo`, `5.1`, `7.1`. Not constrained. Pairs with the numeric `channels` field (which is what API consumers project into `rich_metadata`); `audio_layout` is preserved on the probe row for UI display (\"5.1 surround\") without forcing the UI to derive a label from the integer.
     *
     * @return self
     */
    public function setAudioLayout($audio_layout)
    {
        if (is_null($audio_layout)) {
            throw new \InvalidArgumentException('non-nullable audio_layout cannot be null');
        }
        $this->container['audio_layout'] = $audio_layout;

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
     * @param int|null $channels Numeric audio channel count derived by the Lambda from ffprobe output. Examples: `1` (mono), `2` (stereo), `6` (5.1), `8` (7.1). Pairs with `audio_layout`. Audio + video.
     *
     * @return self
     */
    public function setChannels($channels)
    {
        if (is_null($channels)) {
            throw new \InvalidArgumentException('non-nullable channels cannot be null');
        }

        if (($channels < 1)) {
            throw new \InvalidArgumentException('invalid value for $channels when calling UploadProbeMediaMetadata., must be bigger than or equal to 1.');
        }

        $this->container['channels'] = $channels;

        return $this;
    }

    /**
     * Gets sample_rate_hz
     *
     * @return int|null
     */
    public function getSampleRateHz()
    {
        return $this->container['sample_rate_hz'];
    }

    /**
     * Sets sample_rate_hz
     *
     * @param int|null $sample_rate_hz Audio sample rate, **Hertz**. Units in the field name, mirroring `duration_seconds` / `bitrate_bps`. Examples: `44100`, `48000`. Audio + video-with-audio.
     *
     * @return self
     */
    public function setSampleRateHz($sample_rate_hz)
    {
        if (is_null($sample_rate_hz)) {
            throw new \InvalidArgumentException('non-nullable sample_rate_hz cannot be null');
        }

        if (($sample_rate_hz < 1)) {
            throw new \InvalidArgumentException('invalid value for $sample_rate_hz when calling UploadProbeMediaMetadata., must be bigger than or equal to 1.');
        }

        $this->container['sample_rate_hz'] = $sample_rate_hz;

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
     * @param int|null $page_count Document page count (PDF / EPUB / DOCX / XLSX / PPTX / ODT / ODS / ODP). `0` for a document the prober opened but found empty.
     *
     * @return self
     */
    public function setPageCount($page_count)
    {
        if (is_null($page_count)) {
            throw new \InvalidArgumentException('non-nullable page_count cannot be null');
        }

        if (($page_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $page_count when calling UploadProbeMediaMetadata., must be bigger than or equal to 0.');
        }

        $this->container['page_count'] = $page_count;

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
     * @param int|null $dpi Document resolution, single-axis (dots per inch). Single-axis matches the existing `MetadataResponse` contract on the OpenAPI side; the prober reports the page-1 horizontal DPI when the document declares it, otherwise omits the field.
     *
     * @return self
     */
    public function setDpi($dpi)
    {
        if (is_null($dpi)) {
            throw new \InvalidArgumentException('non-nullable dpi cannot be null');
        }

        if (($dpi < 1)) {
            throw new \InvalidArgumentException('invalid value for $dpi when calling UploadProbeMediaMetadata., must be bigger than or equal to 1.');
        }

        $this->container['dpi'] = $dpi;

        return $this;
    }

    /**
     * Gets video_stream_count
     *
     * @return int|null
     */
    public function getVideoStreamCount()
    {
        return $this->container['video_stream_count'];
    }

    /**
     * Sets video_stream_count
     *
     * @param int|null $video_stream_count Streams whose ffprobe `codec_type` is `video`.
     *
     * @return self
     */
    public function setVideoStreamCount($video_stream_count)
    {
        if (is_null($video_stream_count)) {
            throw new \InvalidArgumentException('non-nullable video_stream_count cannot be null');
        }

        if (($video_stream_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $video_stream_count when calling UploadProbeMediaMetadata., must be bigger than or equal to 0.');
        }

        $this->container['video_stream_count'] = $video_stream_count;

        return $this;
    }

    /**
     * Gets audio_stream_count
     *
     * @return int|null
     */
    public function getAudioStreamCount()
    {
        return $this->container['audio_stream_count'];
    }

    /**
     * Sets audio_stream_count
     *
     * @param int|null $audio_stream_count Streams whose ffprobe `codec_type` is `audio`.
     *
     * @return self
     */
    public function setAudioStreamCount($audio_stream_count)
    {
        if (is_null($audio_stream_count)) {
            throw new \InvalidArgumentException('non-nullable audio_stream_count cannot be null');
        }

        if (($audio_stream_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $audio_stream_count when calling UploadProbeMediaMetadata., must be bigger than or equal to 0.');
        }

        $this->container['audio_stream_count'] = $audio_stream_count;

        return $this;
    }

    /**
     * Gets other_stream_count
     *
     * @return int|null
     */
    public function getOtherStreamCount()
    {
        return $this->container['other_stream_count'];
    }

    /**
     * Sets other_stream_count
     *
     * @param int|null $other_stream_count Every other stream: `codec_type` subtitle, data, attachment, or unknown — the worker gate's `other` bucket.
     *
     * @return self
     */
    public function setOtherStreamCount($other_stream_count)
    {
        if (is_null($other_stream_count)) {
            throw new \InvalidArgumentException('non-nullable other_stream_count cannot be null');
        }

        if (($other_stream_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $other_stream_count when calling UploadProbeMediaMetadata., must be bigger than or equal to 0.');
        }

        $this->container['other_stream_count'] = $other_stream_count;

        return $this;
    }

    /**
     * Gets stream_order
     *
     * @return string[]|null
     */
    public function getStreamOrder()
    {
        return $this->container['stream_order'];
    }

    /**
     * Sets stream_order
     *
     * @param string[]|null $stream_order Per stream index, in container order, its kind (`other` as above). Two inputs are order-compatible iff these are equal.
     *
     * @return self
     */
    public function setStreamOrder($stream_order)
    {
        if (is_null($stream_order)) {
            throw new \InvalidArgumentException('non-nullable stream_order cannot be null');
        }
        $allowedValues = $this->getStreamOrderAllowableValues();
        if (array_diff($stream_order, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'stream_order', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['stream_order'] = $stream_order;

        return $this;
    }

    /**
     * Gets r_frame_rate
     *
     * @return string|null
     */
    public function getRFrameRate()
    {
        return $this->container['r_frame_rate'];
    }

    /**
     * Sets r_frame_rate
     *
     * @param string|null $r_frame_rate ffprobe `r_frame_rate` of the video stream, raw (`30000/1001`; ffprobe's `0/0` is carried as-is and means UNUSABLE). NOT the average rate in `fps`, which drifts between concat-uniform clips. **The worker's frame-rate rule, which a create-time comparison must reproduce exactly:** (1) `r_frame_rate` and `avg_frame_rate` must each be present on all inputs or absent on all (else `input_metadata_inconsistent`); (2) if every input has a usable `r_frame_rate`, compare those as parsed rationals; (3) otherwise compare `avg_frame_rate` as parsed rationals. Both comparisons are by VALUE (`60/2` equals `30/1`), never by string.
     *
     * @return self
     */
    public function setRFrameRate($r_frame_rate)
    {
        if (is_null($r_frame_rate)) {
            throw new \InvalidArgumentException('non-nullable r_frame_rate cannot be null');
        }

        if ((!preg_match("/^[0-9]+\/[0-9]+$/", ObjectSerializer::toString($r_frame_rate)))) {
            throw new \InvalidArgumentException("invalid value for \$r_frame_rate when calling UploadProbeMediaMetadata., must conform to the pattern /^[0-9]+\/[0-9]+$/.");
        }

        $this->container['r_frame_rate'] = $r_frame_rate;

        return $this;
    }

    /**
     * Gets avg_frame_rate
     *
     * @return string|null
     */
    public function getAvgFrameRate()
    {
        return $this->container['avg_frame_rate'];
    }

    /**
     * Sets avg_frame_rate
     *
     * @param string|null $avg_frame_rate ffprobe `avg_frame_rate` of the video stream, raw rational. Presence-checked always; compared only as the fallback in the `r_frame_rate` rule. `fps` is its lossy numeric form.
     *
     * @return self
     */
    public function setAvgFrameRate($avg_frame_rate)
    {
        if (is_null($avg_frame_rate)) {
            throw new \InvalidArgumentException('non-nullable avg_frame_rate cannot be null');
        }

        if ((!preg_match("/^[0-9]+\/[0-9]+$/", ObjectSerializer::toString($avg_frame_rate)))) {
            throw new \InvalidArgumentException("invalid value for \$avg_frame_rate when calling UploadProbeMediaMetadata., must conform to the pattern /^[0-9]+\/[0-9]+$/.");
        }

        $this->container['avg_frame_rate'] = $avg_frame_rate;

        return $this;
    }

    /**
     * Gets pix_fmt
     *
     * @return string|null
     */
    public function getPixFmt()
    {
        return $this->container['pix_fmt'];
    }

    /**
     * Sets pix_fmt
     *
     * @param string|null $pix_fmt ffprobe `pix_fmt` of the video stream (e.g. `yuv420p`).
     *
     * @return self
     */
    public function setPixFmt($pix_fmt)
    {
        if (is_null($pix_fmt)) {
            throw new \InvalidArgumentException('non-nullable pix_fmt cannot be null');
        }
        $this->container['pix_fmt'] = $pix_fmt;

        return $this;
    }

    /**
     * Gets sar
     *
     * @return string|null
     */
    public function getSar()
    {
        return $this->container['sar'];
    }

    /**
     * Sets sar
     *
     * @param string|null $sar Sample aspect ratio of the video stream (`1:1`).
     *
     * @return self
     */
    public function setSar($sar)
    {
        if (is_null($sar)) {
            throw new \InvalidArgumentException('non-nullable sar cannot be null');
        }

        if ((!preg_match("/^[0-9]+:[0-9]+$/", ObjectSerializer::toString($sar)))) {
            throw new \InvalidArgumentException("invalid value for \$sar when calling UploadProbeMediaMetadata., must conform to the pattern /^[0-9]+:[0-9]+$/.");
        }

        $this->container['sar'] = $sar;

        return $this;
    }

    /**
     * Gets video_time_base
     *
     * @return string|null
     */
    public function getVideoTimeBase()
    {
        return $this->container['video_time_base'];
    }

    /**
     * Sets video_time_base
     *
     * @param string|null $video_time_base ffprobe `time_base` of the video stream (`1/30000`).
     *
     * @return self
     */
    public function setVideoTimeBase($video_time_base)
    {
        if (is_null($video_time_base)) {
            throw new \InvalidArgumentException('non-nullable video_time_base cannot be null');
        }

        if ((!preg_match("/^[0-9]+\/[0-9]+$/", ObjectSerializer::toString($video_time_base)))) {
            throw new \InvalidArgumentException("invalid value for \$video_time_base when calling UploadProbeMediaMetadata., must conform to the pattern /^[0-9]+\/[0-9]+$/.");
        }

        $this->container['video_time_base'] = $video_time_base;

        return $this;
    }

    /**
     * Gets audio_time_base
     *
     * @return string|null
     */
    public function getAudioTimeBase()
    {
        return $this->container['audio_time_base'];
    }

    /**
     * Sets audio_time_base
     *
     * @param string|null $audio_time_base ffprobe `time_base` of the audio stream (`1/48000`).
     *
     * @return self
     */
    public function setAudioTimeBase($audio_time_base)
    {
        if (is_null($audio_time_base)) {
            throw new \InvalidArgumentException('non-nullable audio_time_base cannot be null');
        }

        if ((!preg_match("/^[0-9]+\/[0-9]+$/", ObjectSerializer::toString($audio_time_base)))) {
            throw new \InvalidArgumentException("invalid value for \$audio_time_base when calling UploadProbeMediaMetadata., must conform to the pattern /^[0-9]+\/[0-9]+$/.");
        }

        $this->container['audio_time_base'] = $audio_time_base;

        return $this;
    }

    /**
     * Gets codec_tag
     *
     * @return string|null
     */
    public function getCodecTag()
    {
        return $this->container['codec_tag'];
    }

    /**
     * Sets codec_tag
     *
     * @param string|null $codec_tag ffprobe `codec_tag_string` of the video stream (e.g. `avc1`).
     *
     * @return self
     */
    public function setCodecTag($codec_tag)
    {
        if (is_null($codec_tag)) {
            throw new \InvalidArgumentException('non-nullable codec_tag cannot be null');
        }
        $this->container['codec_tag'] = $codec_tag;

        return $this;
    }

    /**
     * Gets profile
     *
     * @return string|null
     */
    public function getProfile()
    {
        return $this->container['profile'];
    }

    /**
     * Sets profile
     *
     * @param string|null $profile ffprobe `profile` of the video stream (e.g. `High`).
     *
     * @return self
     */
    public function setProfile($profile)
    {
        if (is_null($profile)) {
            throw new \InvalidArgumentException('non-nullable profile cannot be null');
        }
        $this->container['profile'] = $profile;

        return $this;
    }

    /**
     * Gets sample_fmt
     *
     * @return string|null
     */
    public function getSampleFmt()
    {
        return $this->container['sample_fmt'];
    }

    /**
     * Sets sample_fmt
     *
     * @param string|null $sample_fmt ffprobe `sample_fmt` of the audio stream (e.g. `fltp`).
     *
     * @return self
     */
    public function setSampleFmt($sample_fmt)
    {
        if (is_null($sample_fmt)) {
            throw new \InvalidArgumentException('non-nullable sample_fmt cannot be null');
        }
        $this->container['sample_fmt'] = $sample_fmt;

        return $this;
    }

    /**
     * Gets probed_at
     *
     * @return \DateTime
     */
    public function getProbedAt()
    {
        return $this->container['probed_at'];
    }

    /**
     * Sets probed_at
     *
     * @param \DateTime $probed_at ISO-8601 timestamp at which the probe ran. Idempotent for the same `file_id` — subsequent probe calls return the cached `probed_at`.
     *
     * @return self
     */
    public function setProbedAt($probed_at)
    {
        if (is_null($probed_at)) {
            throw new \InvalidArgumentException('non-nullable probed_at cannot be null');
        }
        $this->container['probed_at'] = $probed_at;

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


