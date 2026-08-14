<?php
/**
 * SseSingleOutputCompletion
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
 * The version of the OpenAPI document: 2.193.0
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
 * SseSingleOutputCompletion Class Doc Comment
 *
 * @category Class
 * @description Single-output branch of &#x60;SseOperationCompletionResult&#x60; — wraps &#x60;OperationResult&#x60; + the shared &#x60;SseCompletionBase&#x60; + pins &#x60;result_kind&#x60; to the literal &#x60;\&quot;single\&quot;&#x60;. See &#x60;SseOperationCompletionResult&#x60; description for the rationale + codegen-quirk context.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SseSingleOutputCompletion implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'SseSingleOutputCompletion';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'download_url' => 'string',
        'size_bytes' => 'int',
        'mime_type' => 'string',
        'export_key' => 'string',
        'metrics' => '\Gisl\Generated\OpenApi\Model\OperationResultMetrics',
        'result_kind' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'download_url' => 'uri',
        'size_bytes' => 'int64',
        'mime_type' => null,
        'export_key' => null,
        'metrics' => null,
        'result_kind' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'download_url' => false,
        'size_bytes' => false,
        'mime_type' => false,
        'export_key' => false,
        'metrics' => false,
        'result_kind' => false
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
        'download_url' => 'download_url',
        'size_bytes' => 'size_bytes',
        'mime_type' => 'mime_type',
        'export_key' => 'export_key',
        'metrics' => 'metrics',
        'result_kind' => 'result_kind'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'download_url' => 'setDownloadUrl',
        'size_bytes' => 'setSizeBytes',
        'mime_type' => 'setMimeType',
        'export_key' => 'setExportKey',
        'metrics' => 'setMetrics',
        'result_kind' => 'setResultKind'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'download_url' => 'getDownloadUrl',
        'size_bytes' => 'getSizeBytes',
        'mime_type' => 'getMimeType',
        'export_key' => 'getExportKey',
        'metrics' => 'getMetrics',
        'result_kind' => 'getResultKind'
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

    public const RESULT_KIND_SINGLE = 'single';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getResultKindAllowableValues()
    {
        return [
            self::RESULT_KIND_SINGLE,
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
        $this->setIfExists('download_url', $data ?? [], null);
        $this->setIfExists('size_bytes', $data ?? [], null);
        $this->setIfExists('mime_type', $data ?? [], null);
        $this->setIfExists('export_key', $data ?? [], null);
        $this->setIfExists('metrics', $data ?? [], null);
        $this->setIfExists('result_kind', $data ?? [], null);
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

        if ($this->container['download_url'] === null) {
            $invalidProperties[] = "'download_url' can't be null";
        }
        if ($this->container['size_bytes'] === null) {
            $invalidProperties[] = "'size_bytes' can't be null";
        }
        if (!is_null($this->container['mime_type']) && (mb_strlen($this->container['mime_type']) > 100)) {
            $invalidProperties[] = "invalid value for 'mime_type', the character length must be smaller than or equal to 100.";
        }

        if ($this->container['result_kind'] === null) {
            $invalidProperties[] = "'result_kind' can't be null";
        }
        $allowedValues = $this->getResultKindAllowableValues();
        if (!is_null($this->container['result_kind']) && !in_array($this->container['result_kind'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'result_kind', must be one of '%s'",
                $this->container['result_kind'],
                implode("', '", $allowedValues)
            );
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
     * Gets download_url
     *
     * @return string
     */
    public function getDownloadUrl()
    {
        return $this->container['download_url'];
    }

    /**
     * Sets download_url
     *
     * @param string $download_url Pre-signed download URL for the operation output
     *
     * @return self
     */
    public function setDownloadUrl($download_url)
    {
        if (is_null($download_url)) {
            throw new \InvalidArgumentException('non-nullable download_url cannot be null');
        }
        $this->container['download_url'] = $download_url;

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
     * @param int $size_bytes Output file size in bytes
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
     * Gets mime_type
     *
     * @return string|null
     */
    public function getMimeType()
    {
        return $this->container['mime_type'];
    }

    /**
     * Sets mime_type
     *
     * @param string|null $mime_type OPTIONAL. MIME type of the produced artifact (the REST read-surface mirror of the AsyncAPI `OperationResult.output_file_type` wire field — the OpenAPI/REST convention names this concept `mime_type`, as on `OperationDownload` / the upload-probe response). Present on completion only.  **Purpose — the auto-format savings readout.** For most traffic the client already knows the output format (compress is same-format; the compress+format facade canonicalizes to a known `convert` target). This field exists for the runtime-format-selection path — `compress` `output_format: auto`/`smallest` (currently `planned`), where the server picks the output format and the client cannot predict it. Combined with `size_bytes` (output size) + `metrics.compression_ratio` (savings), it lets the client render \"AVIF saved 43%\" from a single completion payload without cross-referencing the downloads endpoint. Landed additively now (cf. `output_file_type` / `watermark_id`) so the auto-format path needs no later contract bump; the API populates it when that path ships.
     *
     * @return self
     */
    public function setMimeType($mime_type)
    {
        if (is_null($mime_type)) {
            throw new \InvalidArgumentException('non-nullable mime_type cannot be null');
        }
        if ((mb_strlen($mime_type) > 100)) {
            throw new \InvalidArgumentException('invalid length for $mime_type when calling SseSingleOutputCompletion., must be smaller than or equal to 100.');
        }

        $this->container['mime_type'] = $mime_type;

        return $this;
    }

    /**
     * Gets export_key
     *
     * @return string|null
     */
    public function getExportKey()
    {
        return $this->container['export_key'];
    }

    /**
     * Sets export_key
     *
     * @param string|null $export_key Key in the customer's export destination (if export configured)
     *
     * @return self
     */
    public function setExportKey($export_key)
    {
        if (is_null($export_key)) {
            throw new \InvalidArgumentException('non-nullable export_key cannot be null');
        }
        $this->container['export_key'] = $export_key;

        return $this;
    }

    /**
     * Gets metrics
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationResultMetrics|null
     */
    public function getMetrics()
    {
        return $this->container['metrics'];
    }

    /**
     * Sets metrics
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationResultMetrics|null $metrics metrics
     *
     * @return self
     */
    public function setMetrics($metrics)
    {
        if (is_null($metrics)) {
            throw new \InvalidArgumentException('non-nullable metrics cannot be null');
        }
        $this->container['metrics'] = $metrics;

        return $this;
    }

    /**
     * Gets result_kind
     *
     * @return string
     */
    public function getResultKind()
    {
        return $this->container['result_kind'];
    }

    /**
     * Sets result_kind
     *
     * @param string $result_kind result_kind
     *
     * @return self
     */
    public function setResultKind($result_kind)
    {
        if (is_null($result_kind)) {
            throw new \InvalidArgumentException('non-nullable result_kind cannot be null');
        }
        $allowedValues = $this->getResultKindAllowableValues();
        if (!in_array($result_kind, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'result_kind', must be one of '%s'",
                    $result_kind,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['result_kind'] = $result_kind;

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


