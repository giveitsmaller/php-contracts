<?php
/**
 * UploadThresholds
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
 * The version of the OpenAPI document: 2.189.0
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
 * UploadThresholds Class Doc Comment
 *
 * @category Class
 * @description Canonical upload threshold constants. Per ticket [u0ar7Yye](https://trello.com/c/u0ar7Yye). All values are &#x60;const:&#x60;-pinned so SDK generators emit them as typed binding constants — frontend / API / SDKs reference these instead of hardcoding magic numbers.  These are CONTRACT VALUES, not runtime-discoverable settings. A future runtime &#x60;GET /api/uploads/limits&#x60; endpoint may overlay per-tier or per-environment overrides on top of these baselines (deferred follow-up).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class UploadThresholds implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'UploadThresholds';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'single_shot_max_bytes' => 'int',
        'multipart_chunk_size' => 'int',
        'multipart_concurrency_default' => 'int',
        'multipart_first_chunk_size' => 'int'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'single_shot_max_bytes' => 'int64',
        'multipart_chunk_size' => 'int64',
        'multipart_concurrency_default' => null,
        'multipart_first_chunk_size' => 'int64'
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'single_shot_max_bytes' => false,
        'multipart_chunk_size' => false,
        'multipart_concurrency_default' => false,
        'multipart_first_chunk_size' => false
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
        'single_shot_max_bytes' => 'single_shot_max_bytes',
        'multipart_chunk_size' => 'multipart_chunk_size',
        'multipart_concurrency_default' => 'multipart_concurrency_default',
        'multipart_first_chunk_size' => 'multipart_first_chunk_size'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'single_shot_max_bytes' => 'setSingleShotMaxBytes',
        'multipart_chunk_size' => 'setMultipartChunkSize',
        'multipart_concurrency_default' => 'setMultipartConcurrencyDefault',
        'multipart_first_chunk_size' => 'setMultipartFirstChunkSize'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'single_shot_max_bytes' => 'getSingleShotMaxBytes',
        'multipart_chunk_size' => 'getMultipartChunkSize',
        'multipart_concurrency_default' => 'getMultipartConcurrencyDefault',
        'multipart_first_chunk_size' => 'getMultipartFirstChunkSize'
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

    public const SINGLE_SHOT_MAX_BYTES_NUMBER_10000000 = 10000000;
    public const MULTIPART_CHUNK_SIZE_NUMBER_16777216 = 16777216;
    public const MULTIPART_CONCURRENCY_DEFAULT_NUMBER_4 = 4;
    public const MULTIPART_FIRST_CHUNK_SIZE_NUMBER_8388608 = 8388608;

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSingleShotMaxBytesAllowableValues()
    {
        return [
            self::SINGLE_SHOT_MAX_BYTES_NUMBER_10000000,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMultipartChunkSizeAllowableValues()
    {
        return [
            self::MULTIPART_CHUNK_SIZE_NUMBER_16777216,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMultipartConcurrencyDefaultAllowableValues()
    {
        return [
            self::MULTIPART_CONCURRENCY_DEFAULT_NUMBER_4,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMultipartFirstChunkSizeAllowableValues()
    {
        return [
            self::MULTIPART_FIRST_CHUNK_SIZE_NUMBER_8388608,
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
        $this->setIfExists('single_shot_max_bytes', $data ?? [], null);
        $this->setIfExists('multipart_chunk_size', $data ?? [], null);
        $this->setIfExists('multipart_concurrency_default', $data ?? [], null);
        $this->setIfExists('multipart_first_chunk_size', $data ?? [], null);
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

        if ($this->container['single_shot_max_bytes'] === null) {
            $invalidProperties[] = "'single_shot_max_bytes' can't be null";
        }
        $allowedValues = $this->getSingleShotMaxBytesAllowableValues();
        if (!is_null($this->container['single_shot_max_bytes']) && !in_array($this->container['single_shot_max_bytes'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'single_shot_max_bytes', must be one of '%s'",
                $this->container['single_shot_max_bytes'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['multipart_chunk_size'] === null) {
            $invalidProperties[] = "'multipart_chunk_size' can't be null";
        }
        $allowedValues = $this->getMultipartChunkSizeAllowableValues();
        if (!is_null($this->container['multipart_chunk_size']) && !in_array($this->container['multipart_chunk_size'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'multipart_chunk_size', must be one of '%s'",
                $this->container['multipart_chunk_size'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['multipart_concurrency_default'] === null) {
            $invalidProperties[] = "'multipart_concurrency_default' can't be null";
        }
        $allowedValues = $this->getMultipartConcurrencyDefaultAllowableValues();
        if (!is_null($this->container['multipart_concurrency_default']) && !in_array($this->container['multipart_concurrency_default'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'multipart_concurrency_default', must be one of '%s'",
                $this->container['multipart_concurrency_default'],
                implode("', '", $allowedValues)
            );
        }

        if (($this->container['multipart_concurrency_default'] < 1)) {
            $invalidProperties[] = "invalid value for 'multipart_concurrency_default', must be bigger than or equal to 1.";
        }

        if ($this->container['multipart_first_chunk_size'] === null) {
            $invalidProperties[] = "'multipart_first_chunk_size' can't be null";
        }
        $allowedValues = $this->getMultipartFirstChunkSizeAllowableValues();
        if (!is_null($this->container['multipart_first_chunk_size']) && !in_array($this->container['multipart_first_chunk_size'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'multipart_first_chunk_size', must be one of '%s'",
                $this->container['multipart_first_chunk_size'],
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
     * Gets single_shot_max_bytes
     *
     * @return int
     */
    public function getSingleShotMaxBytes()
    {
        return $this->container['single_shot_max_bytes'];
    }

    /**
     * Sets single_shot_max_bytes
     *
     * @param int $single_shot_max_bytes Maximum file size in bytes for the single-shot upload path (`POST /api/uploads`). Files above this size MUST use the multipart flow (`POST /api/uploads/multipart/initiate` → chunk PUTs → `POST /api/uploads/multipart/complete`). 10 MB / 10,000,000 bytes — chosen to match the ALB-fronted single-request body cap. Raising this requires infrastructure work (ALB swap or rearchitect; out of scope for this ticket).
     *
     * @return self
     */
    public function setSingleShotMaxBytes($single_shot_max_bytes)
    {
        if (is_null($single_shot_max_bytes)) {
            throw new \InvalidArgumentException('non-nullable single_shot_max_bytes cannot be null');
        }
        $allowedValues = $this->getSingleShotMaxBytesAllowableValues();
        if (!in_array($single_shot_max_bytes, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'single_shot_max_bytes', must be one of '%s'",
                    $single_shot_max_bytes,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['single_shot_max_bytes'] = $single_shot_max_bytes;

        return $this;
    }

    /**
     * Gets multipart_chunk_size
     *
     * @return int
     */
    public function getMultipartChunkSize()
    {
        return $this->container['multipart_chunk_size'];
    }

    /**
     * Sets multipart_chunk_size
     *
     * @param int $multipart_chunk_size Recommended chunk size in bytes for multipart upload chunks (16 MiB / 16,777,216 bytes — 1024-based). Raised from 5 MiB by CON-1 (ADR-0011): S3 caps a multipart upload at 10,000 parts, and the Enterprise envelope is a 120 GB hard ceiling. At 16 MiB a 120 GiB object needs 7,680 parts (≤ 10,000, inside AWS's 16–64 MB recommended band); 5 MiB would need 24,576 and 10 MiB 12,288 — both exceed the S3 limit. **Wire-incompatible change** — SDKs pin this as a compile-time constant, so CON-1 and SDK-2 ship as a non-independently-mergeable pair. The server's `MultipartInitiateResponse` returns a `recommended_chunk_size` per file based on first-chunk throughput; SDKs SHOULD prefer that runtime value when present and fall back to this constant otherwise.
     *
     * @return self
     */
    public function setMultipartChunkSize($multipart_chunk_size)
    {
        if (is_null($multipart_chunk_size)) {
            throw new \InvalidArgumentException('non-nullable multipart_chunk_size cannot be null');
        }
        $allowedValues = $this->getMultipartChunkSizeAllowableValues();
        if (!in_array($multipart_chunk_size, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'multipart_chunk_size', must be one of '%s'",
                    $multipart_chunk_size,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['multipart_chunk_size'] = $multipart_chunk_size;

        return $this;
    }

    /**
     * Gets multipart_concurrency_default
     *
     * @return int
     */
    public function getMultipartConcurrencyDefault()
    {
        return $this->container['multipart_concurrency_default'];
    }

    /**
     * Sets multipart_concurrency_default
     *
     * @param int $multipart_concurrency_default Recommended parallel-upload count for multipart chunks (4 simultaneous PUT requests). Matches the existing TS SDK default. Tuning above 4 risks throttling at the S3 + client-bandwidth layers; below 4 hurts overall throughput on typical broadband.
     *
     * @return self
     */
    public function setMultipartConcurrencyDefault($multipart_concurrency_default)
    {
        if (is_null($multipart_concurrency_default)) {
            throw new \InvalidArgumentException('non-nullable multipart_concurrency_default cannot be null');
        }
        $allowedValues = $this->getMultipartConcurrencyDefaultAllowableValues();
        if (!in_array($multipart_concurrency_default, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'multipart_concurrency_default', must be one of '%s'",
                    $multipart_concurrency_default,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (($multipart_concurrency_default < 1)) {
            throw new \InvalidArgumentException('invalid value for $multipart_concurrency_default when calling UploadThresholds., must be bigger than or equal to 1.');
        }

        $this->container['multipart_concurrency_default'] = $multipart_concurrency_default;

        return $this;
    }

    /**
     * Gets multipart_first_chunk_size
     *
     * @return int
     */
    public function getMultipartFirstChunkSize()
    {
        return $this->container['multipart_first_chunk_size'];
    }

    /**
     * Sets multipart_first_chunk_size
     *
     * @param int $multipart_first_chunk_size Fixed size in bytes for the FIRST chunk PUT in a multipart upload (8 MiB / 8,388,608 bytes — 1024-based). The server uses this chunk for MIME-type detection and throughput measurement; the 8 MiB window is assumed by the server's container-metadata probe (see `MultipartInitiateRequest.metadata_hint`). SDKs MUST send exactly this size for chunk index 0; for chunks 1+ they SHOULD prefer the runtime `MultipartInitiateResponse.recommended_chunk_size` and fall back to `multipart_chunk_size` when absent.
     *
     * @return self
     */
    public function setMultipartFirstChunkSize($multipart_first_chunk_size)
    {
        if (is_null($multipart_first_chunk_size)) {
            throw new \InvalidArgumentException('non-nullable multipart_first_chunk_size cannot be null');
        }
        $allowedValues = $this->getMultipartFirstChunkSizeAllowableValues();
        if (!in_array($multipart_first_chunk_size, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'multipart_first_chunk_size', must be one of '%s'",
                    $multipart_first_chunk_size,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['multipart_first_chunk_size'] = $multipart_first_chunk_size;

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


