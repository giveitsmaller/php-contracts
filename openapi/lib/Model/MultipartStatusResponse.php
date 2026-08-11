<?php
/**
 * MultipartStatusResponse
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
 * MultipartStatusResponse Class Doc Comment
 *
 * @category Class
 * @description Resume-state snapshot for an in-flight multipart session. The &#x60;data&#x60; payload on &#x60;GET /api/uploads/multipart/{uploadId}/status&#x60;.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MultipartStatusResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'MultipartStatusResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'upload_id' => 'string',
        'multipart_upload_id' => 'string',
        'cloud_key' => 'string',
        'total_parts' => 'int',
        'uploaded_parts' => '\Gisl\Generated\OpenApi\Model\MultipartPartListing[]',
        'next_part_number_marker' => 'int',
        'is_truncated' => 'bool',
        'manifest_expires_at' => '\DateTime',
        'recommended_chunk_size' => 'int'
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
        'multipart_upload_id' => null,
        'cloud_key' => null,
        'total_parts' => null,
        'uploaded_parts' => null,
        'next_part_number_marker' => null,
        'is_truncated' => null,
        'manifest_expires_at' => 'date-time',
        'recommended_chunk_size' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'upload_id' => false,
        'multipart_upload_id' => false,
        'cloud_key' => false,
        'total_parts' => false,
        'uploaded_parts' => false,
        'next_part_number_marker' => true,
        'is_truncated' => false,
        'manifest_expires_at' => true,
        'recommended_chunk_size' => false
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
        'multipart_upload_id' => 'multipart_upload_id',
        'cloud_key' => 'cloud_key',
        'total_parts' => 'total_parts',
        'uploaded_parts' => 'uploaded_parts',
        'next_part_number_marker' => 'next_part_number_marker',
        'is_truncated' => 'is_truncated',
        'manifest_expires_at' => 'manifest_expires_at',
        'recommended_chunk_size' => 'recommended_chunk_size'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'upload_id' => 'setUploadId',
        'multipart_upload_id' => 'setMultipartUploadId',
        'cloud_key' => 'setCloudKey',
        'total_parts' => 'setTotalParts',
        'uploaded_parts' => 'setUploadedParts',
        'next_part_number_marker' => 'setNextPartNumberMarker',
        'is_truncated' => 'setIsTruncated',
        'manifest_expires_at' => 'setManifestExpiresAt',
        'recommended_chunk_size' => 'setRecommendedChunkSize'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'upload_id' => 'getUploadId',
        'multipart_upload_id' => 'getMultipartUploadId',
        'cloud_key' => 'getCloudKey',
        'total_parts' => 'getTotalParts',
        'uploaded_parts' => 'getUploadedParts',
        'next_part_number_marker' => 'getNextPartNumberMarker',
        'is_truncated' => 'getIsTruncated',
        'manifest_expires_at' => 'getManifestExpiresAt',
        'recommended_chunk_size' => 'getRecommendedChunkSize'
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
        $this->setIfExists('multipart_upload_id', $data ?? [], null);
        $this->setIfExists('cloud_key', $data ?? [], null);
        $this->setIfExists('total_parts', $data ?? [], null);
        $this->setIfExists('uploaded_parts', $data ?? [], null);
        $this->setIfExists('next_part_number_marker', $data ?? [], null);
        $this->setIfExists('is_truncated', $data ?? [], null);
        $this->setIfExists('manifest_expires_at', $data ?? [], null);
        $this->setIfExists('recommended_chunk_size', $data ?? [], null);
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

        if ($this->container['multipart_upload_id'] === null) {
            $invalidProperties[] = "'multipart_upload_id' can't be null";
        }
        if ($this->container['cloud_key'] === null) {
            $invalidProperties[] = "'cloud_key' can't be null";
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

        if ($this->container['uploaded_parts'] === null) {
            $invalidProperties[] = "'uploaded_parts' can't be null";
        }
        if ($this->container['next_part_number_marker'] === null && !$this->isNullableSetToNull('next_part_number_marker')) {
            $invalidProperties[] = "'next_part_number_marker' can't be null";
        }
        if (($this->container['next_part_number_marker'] > 9999)) {
            $invalidProperties[] = "invalid value for 'next_part_number_marker', must be smaller than or equal to 9999.";
        }

        if (($this->container['next_part_number_marker'] < 0)) {
            $invalidProperties[] = "invalid value for 'next_part_number_marker', must be bigger than or equal to 0.";
        }

        if ($this->container['is_truncated'] === null) {
            $invalidProperties[] = "'is_truncated' can't be null";
        }
        if ($this->container['manifest_expires_at'] === null && !$this->isNullableSetToNull('manifest_expires_at')) {
            $invalidProperties[] = "'manifest_expires_at' can't be null";
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
     * @param string $upload_id Session identifier (matches the path `uploadId` and the initiate response `upload_id`).
     *
     * @return self
     */
    public function setUploadId($upload_id)
    {
        if (is_null($upload_id)) {
            throw new \InvalidArgumentException('non-nullable upload_id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($upload_id)))) {
            throw new \InvalidArgumentException("invalid value for \$upload_id when calling MultipartStatusResponse., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['upload_id'] = $upload_id;

        return $this;
    }

    /**
     * Gets multipart_upload_id
     *
     * @return string
     */
    public function getMultipartUploadId()
    {
        return $this->container['multipart_upload_id'];
    }

    /**
     * Sets multipart_upload_id
     *
     * @param string $multipart_upload_id S3 multipart upload identifier returned by `CreateMultipartUpload`. Opaque to API consumers; emitted for diagnostic visibility (SDK logs / dashboards correlating against AWS CloudTrail).
     *
     * @return self
     */
    public function setMultipartUploadId($multipart_upload_id)
    {
        if (is_null($multipart_upload_id)) {
            throw new \InvalidArgumentException('non-nullable multipart_upload_id cannot be null');
        }
        $this->container['multipart_upload_id'] = $multipart_upload_id;

        return $this;
    }

    /**
     * Gets cloud_key
     *
     * @return string
     */
    public function getCloudKey()
    {
        return $this->container['cloud_key'];
    }

    /**
     * Sets cloud_key
     *
     * @param string $cloud_key S3 object key under which the assembled object will be stored on `multipart/complete`. Opaque to consumers.
     *
     * @return self
     */
    public function setCloudKey($cloud_key)
    {
        if (is_null($cloud_key)) {
            throw new \InvalidArgumentException('non-nullable cloud_key cannot be null');
        }
        $this->container['cloud_key'] = $cloud_key;

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
     * @param int $total_parts Total number of parts the client must upload to complete the session. Same value as `MultipartInitiateResponse.total_parts` and stable for the lifetime of the session.
     *
     * @return self
     */
    public function setTotalParts($total_parts)
    {
        if (is_null($total_parts)) {
            throw new \InvalidArgumentException('non-nullable total_parts cannot be null');
        }

        if (($total_parts > 10000)) {
            throw new \InvalidArgumentException('invalid value for $total_parts when calling MultipartStatusResponse., must be smaller than or equal to 10000.');
        }
        if (($total_parts < 2)) {
            throw new \InvalidArgumentException('invalid value for $total_parts when calling MultipartStatusResponse., must be bigger than or equal to 2.');
        }

        $this->container['total_parts'] = $total_parts;

        return $this;
    }

    /**
     * Gets uploaded_parts
     *
     * @return \Gisl\Generated\OpenApi\Model\MultipartPartListing[]
     */
    public function getUploadedParts()
    {
        return $this->container['uploaded_parts'];
    }

    /**
     * Sets uploaded_parts
     *
     * @param \Gisl\Generated\OpenApi\Model\MultipartPartListing[] $uploaded_parts Parts already present in S3 for this session, as reported by S3 ListParts at request time. May be empty (no parts uploaded yet) or partial (resume mid-upload). Order is the S3-native part-number ascending.
     *
     * @return self
     */
    public function setUploadedParts($uploaded_parts)
    {
        if (is_null($uploaded_parts)) {
            throw new \InvalidArgumentException('non-nullable uploaded_parts cannot be null');
        }
        $this->container['uploaded_parts'] = $uploaded_parts;

        return $this;
    }

    /**
     * Gets next_part_number_marker
     *
     * @return int|null
     */
    public function getNextPartNumberMarker()
    {
        return $this->container['next_part_number_marker'];
    }

    /**
     * Sets next_part_number_marker
     *
     * @param int|null $next_part_number_marker next_part_number_marker
     *
     * @return self
     */
    public function setNextPartNumberMarker($next_part_number_marker)
    {
        if (is_null($next_part_number_marker)) {
            array_push($this->openAPINullablesSetToNull, 'next_part_number_marker');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('next_part_number_marker', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($next_part_number_marker) && ($next_part_number_marker > 9999)) {
            throw new \InvalidArgumentException('invalid value for $next_part_number_marker when calling MultipartStatusResponse., must be smaller than or equal to 9999.');
        }
        if (!is_null($next_part_number_marker) && ($next_part_number_marker < 0)) {
            throw new \InvalidArgumentException('invalid value for $next_part_number_marker when calling MultipartStatusResponse., must be bigger than or equal to 0.');
        }

        $this->container['next_part_number_marker'] = $next_part_number_marker;

        return $this;
    }

    /**
     * Gets is_truncated
     *
     * @return bool
     */
    public function getIsTruncated()
    {
        return $this->container['is_truncated'];
    }

    /**
     * Sets is_truncated
     *
     * @param bool $is_truncated `true` when more pages remain; `false` on the final page. Mirrors the S3 ListParts `IsTruncated` field verbatim.
     *
     * @return self
     */
    public function setIsTruncated($is_truncated)
    {
        if (is_null($is_truncated)) {
            throw new \InvalidArgumentException('non-nullable is_truncated cannot be null');
        }
        $this->container['is_truncated'] = $is_truncated;

        return $this;
    }

    /**
     * Gets manifest_expires_at
     *
     * @return \DateTime|null
     */
    public function getManifestExpiresAt()
    {
        return $this->container['manifest_expires_at'];
    }

    /**
     * Sets manifest_expires_at
     *
     * @param \DateTime|null $manifest_expires_at manifest_expires_at
     *
     * @return self
     */
    public function setManifestExpiresAt($manifest_expires_at)
    {
        if (is_null($manifest_expires_at)) {
            array_push($this->openAPINullablesSetToNull, 'manifest_expires_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('manifest_expires_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['manifest_expires_at'] = $manifest_expires_at;

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
     * @param int $recommended_chunk_size Chunk size (bytes) the server recommends for any remaining parts in this session — identical to `MultipartInitiateResponse.recommended_chunk_size` (16 MiB floor / 100 MiB ceiling per CON-1 / ADR-0011). Returned on every page so the client doesn't need to retain the initiate response across a resume.
     *
     * @return self
     */
    public function setRecommendedChunkSize($recommended_chunk_size)
    {
        if (is_null($recommended_chunk_size)) {
            throw new \InvalidArgumentException('non-nullable recommended_chunk_size cannot be null');
        }

        if (($recommended_chunk_size > 104857600)) {
            throw new \InvalidArgumentException('invalid value for $recommended_chunk_size when calling MultipartStatusResponse., must be smaller than or equal to 104857600.');
        }
        if (($recommended_chunk_size < 16777216)) {
            throw new \InvalidArgumentException('invalid value for $recommended_chunk_size when calling MultipartStatusResponse., must be bigger than or equal to 16777216.');
        }

        $this->container['recommended_chunk_size'] = $recommended_chunk_size;

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


