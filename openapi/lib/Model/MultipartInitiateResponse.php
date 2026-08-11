<?php
/**
 * MultipartInitiateResponse
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
 * The version of the OpenAPI document: 2.188.0
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
 * MultipartInitiateResponse Class Doc Comment
 *
 * @category Class
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MultipartInitiateResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'MultipartInitiateResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'upload_id' => 'string',
        'mime_type' => 'string',
        'first_chunk_etag' => 'string',
        'first_chunk_size_bytes' => 'int',
        'total_parts' => 'int',
        'recommended_chunk_size' => 'int',
        'presigned_urls' => '\Gisl\Generated\OpenApi\Model\PresignedUrlPart[]',
        'constraints_applied' => '\Gisl\Generated\OpenApi\Model\UploadConstraintsApplied'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'upload_id' => 'uuid',
        'mime_type' => null,
        'first_chunk_etag' => null,
        'first_chunk_size_bytes' => null,
        'total_parts' => null,
        'recommended_chunk_size' => null,
        'presigned_urls' => null,
        'constraints_applied' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'upload_id' => false,
        'mime_type' => false,
        'first_chunk_etag' => false,
        'first_chunk_size_bytes' => false,
        'total_parts' => false,
        'recommended_chunk_size' => false,
        'presigned_urls' => false,
        'constraints_applied' => false
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
        'upload_id' => 'upload_id',
        'mime_type' => 'mime_type',
        'first_chunk_etag' => 'first_chunk_etag',
        'first_chunk_size_bytes' => 'first_chunk_size_bytes',
        'total_parts' => 'total_parts',
        'recommended_chunk_size' => 'recommended_chunk_size',
        'presigned_urls' => 'presigned_urls',
        'constraints_applied' => 'constraints_applied'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'upload_id' => 'setUploadId',
        'mime_type' => 'setMimeType',
        'first_chunk_etag' => 'setFirstChunkEtag',
        'first_chunk_size_bytes' => 'setFirstChunkSizeBytes',
        'total_parts' => 'setTotalParts',
        'recommended_chunk_size' => 'setRecommendedChunkSize',
        'presigned_urls' => 'setPresignedUrls',
        'constraints_applied' => 'setConstraintsApplied'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'upload_id' => 'getUploadId',
        'mime_type' => 'getMimeType',
        'first_chunk_etag' => 'getFirstChunkEtag',
        'first_chunk_size_bytes' => 'getFirstChunkSizeBytes',
        'total_parts' => 'getTotalParts',
        'recommended_chunk_size' => 'getRecommendedChunkSize',
        'presigned_urls' => 'getPresignedUrls',
        'constraints_applied' => 'getConstraintsApplied'
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
        $this->setIfExists('upload_id', $data ?? [], null);
        $this->setIfExists('mime_type', $data ?? [], null);
        $this->setIfExists('first_chunk_etag', $data ?? [], null);
        $this->setIfExists('first_chunk_size_bytes', $data ?? [], null);
        $this->setIfExists('total_parts', $data ?? [], null);
        $this->setIfExists('recommended_chunk_size', $data ?? [], null);
        $this->setIfExists('presigned_urls', $data ?? [], null);
        $this->setIfExists('constraints_applied', $data ?? [], null);
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

        if ($this->container['upload_id'] === null) {
            $invalidProperties[] = "'upload_id' can't be null";
        }
        if (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['upload_id'])) {
            $invalidProperties[] = "invalid value for 'upload_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['mime_type'] === null) {
            $invalidProperties[] = "'mime_type' can't be null";
        }
        if ($this->container['first_chunk_etag'] === null) {
            $invalidProperties[] = "'first_chunk_etag' can't be null";
        }
        if ($this->container['first_chunk_size_bytes'] === null) {
            $invalidProperties[] = "'first_chunk_size_bytes' can't be null";
        }
        if ($this->container['total_parts'] === null) {
            $invalidProperties[] = "'total_parts' can't be null";
        }
        if (($this->container['total_parts'] > 10000)) {
            $invalidProperties[] = "invalid value for 'total_parts', must be smaller than or equal to 10000.";
        }

        if (($this->container['total_parts'] < 2)) {
            $invalidProperties[] = "invalid value for 'total_parts', must be bigger than or equal to 2.";
        }

        if ($this->container['recommended_chunk_size'] === null) {
            $invalidProperties[] = "'recommended_chunk_size' can't be null";
        }
        if (($this->container['recommended_chunk_size'] > 104857600)) {
            $invalidProperties[] = "invalid value for 'recommended_chunk_size', must be smaller than or equal to 104857600.";
        }

        if (($this->container['recommended_chunk_size'] < 16777216)) {
            $invalidProperties[] = "invalid value for 'recommended_chunk_size', must be bigger than or equal to 16777216.";
        }

        if ($this->container['presigned_urls'] === null) {
            $invalidProperties[] = "'presigned_urls' can't be null";
        }
        if ($this->container['constraints_applied'] === null) {
            $invalidProperties[] = "'constraints_applied' can't be null";
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
     * Gets upload_id
     *
     * @return string
     */
    public function getUploadId()
    {
        return $this->container['upload_id'];
    }

    /**
     * Sets upload_id
     *
     * @param string $upload_id Multipart upload session identifier. Pass this as `upload_id` in the complete request; after completion, pass the same value as `file_id` when creating workflows via `POST /api/workflows`.
     *
     * @return self
     */
    public function setUploadId($upload_id)
    {
        if (is_null($upload_id)) {
            throw new \InvalidArgumentException('non-nullable upload_id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($upload_id)))) {
            throw new \InvalidArgumentException("invalid value for \$upload_id when calling MultipartInitiateResponse., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['upload_id'] = $upload_id;

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
     * @param string $mime_type MIME type detected from the first chunk
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
     * Gets first_chunk_etag
     *
     * @return string
     */
    public function getFirstChunkEtag()
    {
        return $this->container['first_chunk_etag'];
    }

    /**
     * Sets first_chunk_etag
     *
     * @param string $first_chunk_etag ETag of the first chunk stored as S3 part 1
     *
     * @return self
     */
    public function setFirstChunkEtag($first_chunk_etag)
    {
        if (is_null($first_chunk_etag)) {
            throw new \InvalidArgumentException('non-nullable first_chunk_etag cannot be null');
        }
        $this->container['first_chunk_etag'] = $first_chunk_etag;

        return $this;
    }

    /**
     * Gets first_chunk_size_bytes
     *
     * @return int
     */
    public function getFirstChunkSizeBytes()
    {
        return $this->container['first_chunk_size_bytes'];
    }

    /**
     * Sets first_chunk_size_bytes
     *
     * @param int $first_chunk_size_bytes Size of the first chunk received (for client validation)
     *
     * @return self
     */
    public function setFirstChunkSizeBytes($first_chunk_size_bytes)
    {
        if (is_null($first_chunk_size_bytes)) {
            throw new \InvalidArgumentException('non-nullable first_chunk_size_bytes cannot be null');
        }
        $this->container['first_chunk_size_bytes'] = $first_chunk_size_bytes;

        return $this;
    }

    /**
     * Gets total_parts
     *
     * @return int
     */
    public function getTotalParts()
    {
        return $this->container['total_parts'];
    }

    /**
     * Sets total_parts
     *
     * @param int $total_parts Total number of parts. The client slices the remaining file into exactly (total_parts - 1) chunks using recommended_chunk_size. The last chunk may be smaller. Maximum raised 500 → 10,000 by CON-1 (ADR-0011) — 10,000 is the S3 multipart hard part limit; 500 contract-capped uploads at ≈ 50 GB, below the 120 GB Enterprise envelope.
     *
     * @return self
     */
    public function setTotalParts($total_parts)
    {
        if (is_null($total_parts)) {
            throw new \InvalidArgumentException('non-nullable total_parts cannot be null');
        }

        if (($total_parts > 10000)) {
            throw new \InvalidArgumentException('invalid value for $total_parts when calling MultipartInitiateResponse., must be smaller than or equal to 10000.');
        }
        if (($total_parts < 2)) {
            throw new \InvalidArgumentException('invalid value for $total_parts when calling MultipartInitiateResponse., must be bigger than or equal to 2.');
        }

        $this->container['total_parts'] = $total_parts;

        return $this;
    }

    /**
     * Gets recommended_chunk_size
     *
     * @return int
     */
    public function getRecommendedChunkSize()
    {
        return $this->container['recommended_chunk_size'];
    }

    /**
     * Sets recommended_chunk_size
     *
     * @param int $recommended_chunk_size Chunk size in bytes for remaining parts. Calculated from first chunk throughput * 5s target, clamped to 16 MiB–100 MiB. The last chunk may be smaller than 16 MiB. Minimum raised 5 MiB → 16 MiB by CON-1 (ADR-0011) so the runtime value never falls below the `UploadThresholds.multipart_chunk_size` constant SDKs fall back to (the S3 10,000-part limit at the 120 GB Enterprise ceiling).
     *
     * @return self
     */
    public function setRecommendedChunkSize($recommended_chunk_size)
    {
        if (is_null($recommended_chunk_size)) {
            throw new \InvalidArgumentException('non-nullable recommended_chunk_size cannot be null');
        }

        if (($recommended_chunk_size > 104857600)) {
            throw new \InvalidArgumentException('invalid value for $recommended_chunk_size when calling MultipartInitiateResponse., must be smaller than or equal to 104857600.');
        }
        if (($recommended_chunk_size < 16777216)) {
            throw new \InvalidArgumentException('invalid value for $recommended_chunk_size when calling MultipartInitiateResponse., must be bigger than or equal to 16777216.');
        }

        $this->container['recommended_chunk_size'] = $recommended_chunk_size;

        return $this;
    }

    /**
     * Gets presigned_urls
     *
     * @return \Gisl\Generated\OpenApi\Model\PresignedUrlPart[]
     */
    public function getPresignedUrls()
    {
        return $this->container['presigned_urls'];
    }

    /**
     * Sets presigned_urls
     *
     * @param \Gisl\Generated\OpenApi\Model\PresignedUrlPart[] $presigned_urls Pre-signed S3 PUT URLs for parts 2 through total_parts. Each URL accepts a PUT request with raw chunk bytes as body. Collect the ETag from each S3 response for the complete request.  NOTE (CON-1/ADR-0011): with `total_parts` now bounded by the S3 hard limit (10,000), a maximal Enterprise upload implies a large URL set. The server is NOT required to return every URL in one synchronous response — bounded-batch / paginated URL delivery and resumable re-fetch are owned by API-2 (durable upload session) and SDK-3 (presigned batching + paginated ListParts). Consumers MUST NOT assume a single initiate response carries all `total_parts - 1` URLs at the high end of the range; treat this array as the first batch.
     *
     * @return self
     */
    public function setPresignedUrls($presigned_urls)
    {
        if (is_null($presigned_urls)) {
            throw new \InvalidArgumentException('non-nullable presigned_urls cannot be null');
        }
        $this->container['presigned_urls'] = $presigned_urls;

        return $this;
    }

    /**
     * Gets constraints_applied
     *
     * @return \Gisl\Generated\OpenApi\Model\UploadConstraintsApplied
     */
    public function getConstraintsApplied()
    {
        return $this->container['constraints_applied'];
    }

    /**
     * Sets constraints_applied
     *
     * @param \Gisl\Generated\OpenApi\Model\UploadConstraintsApplied $constraints_applied Tier+MIME-derived constraints the server applied to this multipart session per ticket [I15-CONS](https://trello.com/c/YZpBKzOM) F8.1. REQUIRED on every successful initiate (V2 cutover invariant). The same response shape is also emitted on the multipart complete endpoint via `UploadResponse.constraints_applied`.
     *
     * @return self
     */
    public function setConstraintsApplied($constraints_applied)
    {
        if (is_null($constraints_applied)) {
            throw new \InvalidArgumentException('non-nullable constraints_applied cannot be null');
        }
        $this->container['constraints_applied'] = $constraints_applied;

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


