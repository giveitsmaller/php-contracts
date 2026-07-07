<?php
/**
 * UploadConstraintsApplied
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
 * The version of the OpenAPI document: 2.162.0
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
 * UploadConstraintsApplied Class Doc Comment
 *
 * @category Class
 * @description Tier+MIME-derived constraints that the server applied to this upload. Returned on &#x60;UploadResponse&#x60; and &#x60;MultipartInitiateResponse&#x60; so callers can see what limits their tier permitted (e.g. show the cap in the UI before the user picks a workflow).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class UploadConstraintsApplied implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'UploadConstraintsApplied';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'max_size_bytes' => 'int',
        'max_duration_seconds' => 'int',
        'processing_class_pre_assignment' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'max_size_bytes' => 'int64',
        'max_duration_seconds' => null,
        'processing_class_pre_assignment' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'max_size_bytes' => false,
        'max_duration_seconds' => true,
        'processing_class_pre_assignment' => false
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
        'max_size_bytes' => 'max_size_bytes',
        'max_duration_seconds' => 'max_duration_seconds',
        'processing_class_pre_assignment' => 'processing_class_pre_assignment'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'max_size_bytes' => 'setMaxSizeBytes',
        'max_duration_seconds' => 'setMaxDurationSeconds',
        'processing_class_pre_assignment' => 'setProcessingClassPreAssignment'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'max_size_bytes' => 'getMaxSizeBytes',
        'max_duration_seconds' => 'getMaxDurationSeconds',
        'processing_class_pre_assignment' => 'getProcessingClassPreAssignment'
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

    public const PROCESSING_CLASS_PRE_ASSIGNMENT_SHORT_FORM = 'short_form';
    public const PROCESSING_CLASS_PRE_ASSIGNMENT_LONG_FORM = 'long_form';
    public const PROCESSING_CLASS_PRE_ASSIGNMENT_UNKNOWN = 'unknown';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProcessingClassPreAssignmentAllowableValues()
    {
        return [
            self::PROCESSING_CLASS_PRE_ASSIGNMENT_SHORT_FORM,
            self::PROCESSING_CLASS_PRE_ASSIGNMENT_LONG_FORM,
            self::PROCESSING_CLASS_PRE_ASSIGNMENT_UNKNOWN,
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
        $this->setIfExists('max_size_bytes', $data ?? [], null);
        $this->setIfExists('max_duration_seconds', $data ?? [], null);
        $this->setIfExists('processing_class_pre_assignment', $data ?? [], null);
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

        if ($this->container['max_size_bytes'] === null) {
            $invalidProperties[] = "'max_size_bytes' can't be null";
        }
        if (!is_null($this->container['max_duration_seconds']) && ($this->container['max_duration_seconds'] < 0)) {
            $invalidProperties[] = "invalid value for 'max_duration_seconds', must be bigger than or equal to 0.";
        }

        if ($this->container['processing_class_pre_assignment'] === null) {
            $invalidProperties[] = "'processing_class_pre_assignment' can't be null";
        }
        $allowedValues = $this->getProcessingClassPreAssignmentAllowableValues();
        if (!is_null($this->container['processing_class_pre_assignment']) && !in_array($this->container['processing_class_pre_assignment'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'processing_class_pre_assignment', must be one of '%s'",
                $this->container['processing_class_pre_assignment'],
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
     * Gets max_size_bytes
     *
     * @return int
     */
    public function getMaxSizeBytes()
    {
        return $this->container['max_size_bytes'];
    }

    /**
     * Sets max_size_bytes
     *
     * @param int $max_size_bytes Max file size the upload is permitted under the caller's current tier + MIME. Same value the server would reject with 422 `upload_size_exceeds_tier` if exceeded.
     *
     * @return self
     */
    public function setMaxSizeBytes($max_size_bytes)
    {
        if (is_null($max_size_bytes)) {
            throw new \InvalidArgumentException('non-nullable max_size_bytes cannot be null');
        }
        $this->container['max_size_bytes'] = $max_size_bytes;

        return $this;
    }

    /**
     * Gets max_duration_seconds
     *
     * @return int|null
     */
    public function getMaxDurationSeconds()
    {
        return $this->container['max_duration_seconds'];
    }

    /**
     * Sets max_duration_seconds
     *
     * @param int|null $max_duration_seconds Tier+MIME-derived duration cap. Null when: - The MIME has no duration concept (images, documents). - The server could not derive duration from the first   chunk (multipart-only path; single uploads always   probe).
     *
     * @return self
     */
    public function setMaxDurationSeconds($max_duration_seconds)
    {
        if (is_null($max_duration_seconds)) {
            array_push($this->openAPINullablesSetToNull, 'max_duration_seconds');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('max_duration_seconds', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($max_duration_seconds) && ($max_duration_seconds < 0)) {
            throw new \InvalidArgumentException('invalid value for $max_duration_seconds when calling UploadConstraintsApplied., must be bigger than or equal to 0.');
        }

        $this->container['max_duration_seconds'] = $max_duration_seconds;

        return $this;
    }

    /**
     * Gets processing_class_pre_assignment
     *
     * @return string
     */
    public function getProcessingClassPreAssignment()
    {
        return $this->container['processing_class_pre_assignment'];
    }

    /**
     * Sets processing_class_pre_assignment
     *
     * @param string $processing_class_pre_assignment Server's *current* routing decision based on upload metadata. NOT binding on workflow-create — workflow shape may flip the assignment, especially for multi-input merge. `unknown` when metadata is insufficient.
     *
     * @return self
     */
    public function setProcessingClassPreAssignment($processing_class_pre_assignment)
    {
        if (is_null($processing_class_pre_assignment)) {
            throw new \InvalidArgumentException('non-nullable processing_class_pre_assignment cannot be null');
        }
        $allowedValues = $this->getProcessingClassPreAssignmentAllowableValues();
        if (!in_array($processing_class_pre_assignment, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'processing_class_pre_assignment', must be one of '%s'",
                    $processing_class_pre_assignment,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['processing_class_pre_assignment'] = $processing_class_pre_assignment;

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


