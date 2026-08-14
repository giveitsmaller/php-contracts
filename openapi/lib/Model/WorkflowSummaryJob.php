<?php
/**
 * WorkflowSummaryJob
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
 * The version of the OpenAPI document: 2.194.0
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
 * WorkflowSummaryJob Class Doc Comment
 *
 * @category Class
 * @description Per-job entry in a &#x60;WorkflowSummary&#x60; row. Carries &#x60;job_type&#x60; (media class) + status plus a lightweight at-a-glance enrichment set — &#x60;input_filename&#x60;, an input→output byte summary, and the applied &#x60;operation_types&#x60; — so the list view renders an informative row (e.g. \&quot;vacation.jpg · 1.2 MB → 480 KB · compress, thumbnail\&quot;) WITHOUT an N-row drill-in. Full per-operation detail (&#x60;result_metadata&#x60;, progress, per-output download URLs) remains the drill-in &#x60;GET /api/workflows/{id}/status&#x60; + &#x60;GET /{id}/downloads&#x60;. The enrichment fields are all OPTIONAL (additive): a consumer MUST tolerate their absence, and they are naturally absent for jobs whose input is an upstream &#x60;job_output&#x60; rather than a user upload.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class WorkflowSummaryJob implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'WorkflowSummaryJob';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'job_id' => 'string',
        'ref' => 'string',
        'job_type' => '\Gisl\Generated\OpenApi\Model\JobMediaClass',
        'status' => '\Gisl\Generated\OpenApi\Model\JobStatus',
        'input_filename' => 'string',
        'input_size_bytes' => 'int',
        'output_size_bytes' => 'int',
        'operation_types' => '\Gisl\Generated\OpenApi\Model\OperationType[]'
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
        'ref' => null,
        'job_type' => null,
        'status' => null,
        'input_filename' => null,
        'input_size_bytes' => 'int64',
        'output_size_bytes' => 'int64',
        'operation_types' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'job_id' => false,
        'ref' => false,
        'job_type' => false,
        'status' => false,
        'input_filename' => false,
        'input_size_bytes' => false,
        'output_size_bytes' => false,
        'operation_types' => false
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
        'ref' => 'ref',
        'job_type' => 'job_type',
        'status' => 'status',
        'input_filename' => 'input_filename',
        'input_size_bytes' => 'input_size_bytes',
        'output_size_bytes' => 'output_size_bytes',
        'operation_types' => 'operation_types'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'job_id' => 'setJobId',
        'ref' => 'setRef',
        'job_type' => 'setJobType',
        'status' => 'setStatus',
        'input_filename' => 'setInputFilename',
        'input_size_bytes' => 'setInputSizeBytes',
        'output_size_bytes' => 'setOutputSizeBytes',
        'operation_types' => 'setOperationTypes'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'job_id' => 'getJobId',
        'ref' => 'getRef',
        'job_type' => 'getJobType',
        'status' => 'getStatus',
        'input_filename' => 'getInputFilename',
        'input_size_bytes' => 'getInputSizeBytes',
        'output_size_bytes' => 'getOutputSizeBytes',
        'operation_types' => 'getOperationTypes'
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
        $this->setIfExists('ref', $data ?? [], null);
        $this->setIfExists('job_type', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('input_filename', $data ?? [], null);
        $this->setIfExists('input_size_bytes', $data ?? [], null);
        $this->setIfExists('output_size_bytes', $data ?? [], null);
        $this->setIfExists('operation_types', $data ?? [], null);
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
        if (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['job_id'])) {
            $invalidProperties[] = "invalid value for 'job_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['ref'] === null) {
            $invalidProperties[] = "'ref' can't be null";
        }
        if ($this->container['job_type'] === null) {
            $invalidProperties[] = "'job_type' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if (!is_null($this->container['input_filename']) && (mb_strlen($this->container['input_filename']) > 1024)) {
            $invalidProperties[] = "invalid value for 'input_filename', the character length must be smaller than or equal to 1024.";
        }

        if (!is_null($this->container['input_size_bytes']) && ($this->container['input_size_bytes'] < 0)) {
            $invalidProperties[] = "invalid value for 'input_size_bytes', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['output_size_bytes']) && ($this->container['output_size_bytes'] < 0)) {
            $invalidProperties[] = "invalid value for 'output_size_bytes', must be bigger than or equal to 0.";
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
     * @param string $job_id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setJobId($job_id)
    {
        if (is_null($job_id)) {
            throw new \InvalidArgumentException('non-nullable job_id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($job_id)))) {
            throw new \InvalidArgumentException("invalid value for \$job_id when calling WorkflowSummaryJob., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['job_id'] = $job_id;

        return $this;
    }

    /**
     * Gets ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->container['ref'];
    }

    /**
     * Sets ref
     *
     * @param string $ref Workflow-local job ref (matches `JobResponse.ref`).
     *
     * @return self
     */
    public function setRef($ref)
    {
        if (is_null($ref)) {
            throw new \InvalidArgumentException('non-nullable ref cannot be null');
        }
        $this->container['ref'] = $ref;

        return $this;
    }

    /**
     * Gets job_type
     *
     * @return \Gisl\Generated\OpenApi\Model\JobMediaClass
     */
    public function getJobType()
    {
        return $this->container['job_type'];
    }

    /**
     * Sets job_type
     *
     * @param \Gisl\Generated\OpenApi\Model\JobMediaClass $job_type job_type
     *
     * @return self
     */
    public function setJobType($job_type)
    {
        if (is_null($job_type)) {
            throw new \InvalidArgumentException('non-nullable job_type cannot be null');
        }
        $this->container['job_type'] = $job_type;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \Gisl\Generated\OpenApi\Model\JobStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \Gisl\Generated\OpenApi\Model\JobStatus $status status
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets input_filename
     *
     * @return string|null
     */
    public function getInputFilename()
    {
        return $this->container['input_filename'];
    }

    /**
     * Sets input_filename
     *
     * @param string|null $input_filename OPTIONAL. The user's original input file name (e.g. `vacation.jpg`) — what the list row labels the job with, rather than the FE-assigned `ref`. For multi-input jobs (merge, watermark) this is the primary/`base` input's filename. Absent for jobs whose input is an upstream `job_output` (no original upload name) or when the server has not recorded it.
     *
     * @return self
     */
    public function setInputFilename($input_filename)
    {
        if (is_null($input_filename)) {
            throw new \InvalidArgumentException('non-nullable input_filename cannot be null');
        }
        if ((mb_strlen($input_filename) > 1024)) {
            throw new \InvalidArgumentException('invalid length for $input_filename when calling WorkflowSummaryJob., must be smaller than or equal to 1024.');
        }

        $this->container['input_filename'] = $input_filename;

        return $this;
    }

    /**
     * Gets input_size_bytes
     *
     * @return int|null
     */
    public function getInputSizeBytes()
    {
        return $this->container['input_size_bytes'];
    }

    /**
     * Sets input_size_bytes
     *
     * @param int|null $input_size_bytes OPTIONAL. Original input size in bytes — the left side of the list-row savings readout. This is the job's DIRECT / base originating-upload size (a single base input), **not** a recursive sum of all source inputs; it is omitted for jobs whose input is an upstream `job_output` (merge / derived jobs). Pair with `output_size_bytes` to render \"1.2 MB → 480 KB (↓60%)\" without a drill-in — a non-authoritative at-a-glance summary. Absent when not yet known or not applicable.
     *
     * @return self
     */
    public function setInputSizeBytes($input_size_bytes)
    {
        if (is_null($input_size_bytes)) {
            throw new \InvalidArgumentException('non-nullable input_size_bytes cannot be null');
        }

        if (($input_size_bytes < 0)) {
            throw new \InvalidArgumentException('invalid value for $input_size_bytes when calling WorkflowSummaryJob., must be bigger than or equal to 0.');
        }

        $this->container['input_size_bytes'] = $input_size_bytes;

        return $this;
    }

    /**
     * Gets output_size_bytes
     *
     * @return int|null
     */
    public function getOutputSizeBytes()
    {
        return $this->container['output_size_bytes'];
    }

    /**
     * Sets output_size_bytes
     *
     * @param int|null $output_size_bytes OPTIONAL. Final job output size in bytes — the right side of the before→after savings readout. The **main/terminal deliverable's** size: the **highest-position completed non-thumbnail** operation's output — **NOT a sum across the job's operations** (a thumbnail's size is excluded; for a compress+thumbnail job this is the compressed output). Authoritative per-output sizes remain on `GET /{id}/downloads`. Populated from the highest-position COMPLETED op, so it is **PROVISIONAL while the job is still running** (a later-completing op can become the main deliverable and change this value) and final only once the job reaches a **terminal** status. Absent until a non-thumbnail op has completed with a recorded size.
     *
     * @return self
     */
    public function setOutputSizeBytes($output_size_bytes)
    {
        if (is_null($output_size_bytes)) {
            throw new \InvalidArgumentException('non-nullable output_size_bytes cannot be null');
        }

        if (($output_size_bytes < 0)) {
            throw new \InvalidArgumentException('invalid value for $output_size_bytes when calling WorkflowSummaryJob., must be bigger than or equal to 0.');
        }

        $this->container['output_size_bytes'] = $output_size_bytes;

        return $this;
    }

    /**
     * Gets operation_types
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationType[]|null
     */
    public function getOperationTypes()
    {
        return $this->container['operation_types'];
    }

    /**
     * Sets operation_types
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationType[]|null $operation_types OPTIONAL (nice-to-have). The actual operation types applied in this job (e.g. `[compress, thumbnail]`), beyond the media-class `job_type` — lets the list row show what was DONE without a drill-in. Order follows the job's operation chain. Absent when the server does not project it.
     *
     * @return self
     */
    public function setOperationTypes($operation_types)
    {
        if (is_null($operation_types)) {
            throw new \InvalidArgumentException('non-nullable operation_types cannot be null');
        }
        $this->container['operation_types'] = $operation_types;

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


