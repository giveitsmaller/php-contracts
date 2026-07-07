<?php
/**
 * ProcessingPlanJob
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
 * ProcessingPlanJob Class Doc Comment
 *
 * @category Class
 * @description Per-job entry in the workflow&#39;s &#x60;processing_plan&#x60;. Server emits one entry per job in the workflow (including jobs that run on &#x60;short_form&#x60;).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProcessingPlanJob implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'ProcessingPlanJob';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'job_id' => 'string',
        'processing_class' => '\Gisl\Generated\OpenApi\Model\ProcessingClass',
        'execution_pool' => 'string',
        'estimated_queue_seconds' => '\Gisl\Generated\OpenApi\Model\EstimateRange',
        'estimated_processing_seconds' => '\Gisl\Generated\OpenApi\Model\EstimateRange',
        'estimate_quality' => '\Gisl\Generated\OpenApi\Model\EstimateQuality',
        'reason' => '\Gisl\Generated\OpenApi\Model\ProcessingClassReason'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'job_id' => 'uuid',
        'processing_class' => null,
        'execution_pool' => null,
        'estimated_queue_seconds' => null,
        'estimated_processing_seconds' => null,
        'estimate_quality' => null,
        'reason' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'job_id' => false,
        'processing_class' => false,
        'execution_pool' => false,
        'estimated_queue_seconds' => false,
        'estimated_processing_seconds' => false,
        'estimate_quality' => false,
        'reason' => false
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
        'job_id' => 'job_id',
        'processing_class' => 'processing_class',
        'execution_pool' => 'execution_pool',
        'estimated_queue_seconds' => 'estimated_queue_seconds',
        'estimated_processing_seconds' => 'estimated_processing_seconds',
        'estimate_quality' => 'estimate_quality',
        'reason' => 'reason'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'job_id' => 'setJobId',
        'processing_class' => 'setProcessingClass',
        'execution_pool' => 'setExecutionPool',
        'estimated_queue_seconds' => 'setEstimatedQueueSeconds',
        'estimated_processing_seconds' => 'setEstimatedProcessingSeconds',
        'estimate_quality' => 'setEstimateQuality',
        'reason' => 'setReason'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'job_id' => 'getJobId',
        'processing_class' => 'getProcessingClass',
        'execution_pool' => 'getExecutionPool',
        'estimated_queue_seconds' => 'getEstimatedQueueSeconds',
        'estimated_processing_seconds' => 'getEstimatedProcessingSeconds',
        'estimate_quality' => 'getEstimateQuality',
        'reason' => 'getReason'
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
        $this->setIfExists('job_id', $data ?? [], null);
        $this->setIfExists('processing_class', $data ?? [], null);
        $this->setIfExists('execution_pool', $data ?? [], null);
        $this->setIfExists('estimated_queue_seconds', $data ?? [], null);
        $this->setIfExists('estimated_processing_seconds', $data ?? [], null);
        $this->setIfExists('estimate_quality', $data ?? [], null);
        $this->setIfExists('reason', $data ?? [], null);
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

        if ($this->container['job_id'] === null) {
            $invalidProperties[] = "'job_id' can't be null";
        }
        if ($this->container['processing_class'] === null) {
            $invalidProperties[] = "'processing_class' can't be null";
        }
        if ($this->container['execution_pool'] === null) {
            $invalidProperties[] = "'execution_pool' can't be null";
        }
        if ($this->container['estimated_queue_seconds'] === null) {
            $invalidProperties[] = "'estimated_queue_seconds' can't be null";
        }
        if ($this->container['estimated_processing_seconds'] === null) {
            $invalidProperties[] = "'estimated_processing_seconds' can't be null";
        }
        if ($this->container['estimate_quality'] === null) {
            $invalidProperties[] = "'estimate_quality' can't be null";
        }
        if ($this->container['reason'] === null) {
            $invalidProperties[] = "'reason' can't be null";
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
     * Gets job_id
     *
     * @return string
     */
    public function getJobId()
    {
        return $this->container['job_id'];
    }

    /**
     * Sets job_id
     *
     * @param string $job_id UUID-v7 of the job. Mirrors `JobDefinition.id` after server resolution.
     *
     * @return self
     */
    public function setJobId($job_id)
    {
        if (is_null($job_id)) {
            throw new \InvalidArgumentException('non-nullable job_id cannot be null');
        }
        $this->container['job_id'] = $job_id;

        return $this;
    }

    /**
     * Gets processing_class
     *
     * @return \Gisl\Generated\OpenApi\Model\ProcessingClass
     */
    public function getProcessingClass()
    {
        return $this->container['processing_class'];
    }

    /**
     * Sets processing_class
     *
     * @param \Gisl\Generated\OpenApi\Model\ProcessingClass $processing_class processing_class
     *
     * @return self
     */
    public function setProcessingClass($processing_class)
    {
        if (is_null($processing_class)) {
            throw new \InvalidArgumentException('non-nullable processing_class cannot be null');
        }
        $this->container['processing_class'] = $processing_class;

        return $this;
    }

    /**
     * Gets execution_pool
     *
     * @return string
     */
    public function getExecutionPool()
    {
        return $this->container['execution_pool'];
    }

    /**
     * Sets execution_pool
     *
     * @param string $execution_pool Logical pool name. **Opaque string** — not an enum — so future pool naming evolves without contract churn. Known initial values (informational): `standard`, `priority`, `enterprise_isolated`. SDK + frontend gating logic should switch on `processing_class` (enum), NOT `execution_pool`.
     *
     * @return self
     */
    public function setExecutionPool($execution_pool)
    {
        if (is_null($execution_pool)) {
            throw new \InvalidArgumentException('non-nullable execution_pool cannot be null');
        }
        $this->container['execution_pool'] = $execution_pool;

        return $this;
    }

    /**
     * Gets estimated_queue_seconds
     *
     * @return \Gisl\Generated\OpenApi\Model\EstimateRange
     */
    public function getEstimatedQueueSeconds()
    {
        return $this->container['estimated_queue_seconds'];
    }

    /**
     * Sets estimated_queue_seconds
     *
     * @param \Gisl\Generated\OpenApi\Model\EstimateRange $estimated_queue_seconds estimated_queue_seconds
     *
     * @return self
     */
    public function setEstimatedQueueSeconds($estimated_queue_seconds)
    {
        if (is_null($estimated_queue_seconds)) {
            throw new \InvalidArgumentException('non-nullable estimated_queue_seconds cannot be null');
        }
        $this->container['estimated_queue_seconds'] = $estimated_queue_seconds;

        return $this;
    }

    /**
     * Gets estimated_processing_seconds
     *
     * @return \Gisl\Generated\OpenApi\Model\EstimateRange
     */
    public function getEstimatedProcessingSeconds()
    {
        return $this->container['estimated_processing_seconds'];
    }

    /**
     * Sets estimated_processing_seconds
     *
     * @param \Gisl\Generated\OpenApi\Model\EstimateRange $estimated_processing_seconds estimated_processing_seconds
     *
     * @return self
     */
    public function setEstimatedProcessingSeconds($estimated_processing_seconds)
    {
        if (is_null($estimated_processing_seconds)) {
            throw new \InvalidArgumentException('non-nullable estimated_processing_seconds cannot be null');
        }
        $this->container['estimated_processing_seconds'] = $estimated_processing_seconds;

        return $this;
    }

    /**
     * Gets estimate_quality
     *
     * @return \Gisl\Generated\OpenApi\Model\EstimateQuality
     */
    public function getEstimateQuality()
    {
        return $this->container['estimate_quality'];
    }

    /**
     * Sets estimate_quality
     *
     * @param \Gisl\Generated\OpenApi\Model\EstimateQuality $estimate_quality estimate_quality
     *
     * @return self
     */
    public function setEstimateQuality($estimate_quality)
    {
        if (is_null($estimate_quality)) {
            throw new \InvalidArgumentException('non-nullable estimate_quality cannot be null');
        }
        $this->container['estimate_quality'] = $estimate_quality;

        return $this;
    }

    /**
     * Gets reason
     *
     * @return \Gisl\Generated\OpenApi\Model\ProcessingClassReason
     */
    public function getReason()
    {
        return $this->container['reason'];
    }

    /**
     * Sets reason
     *
     * @param \Gisl\Generated\OpenApi\Model\ProcessingClassReason $reason reason
     *
     * @return self
     */
    public function setReason($reason)
    {
        if (is_null($reason)) {
            throw new \InvalidArgumentException('non-nullable reason cannot be null');
        }
        $this->container['reason'] = $reason;

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


