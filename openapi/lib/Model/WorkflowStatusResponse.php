<?php
/**
 * WorkflowStatusResponse
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
 * The version of the OpenAPI document: 2.154.0
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
 * WorkflowStatusResponse Class Doc Comment
 *
 * @category Class
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class WorkflowStatusResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'WorkflowStatusResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'workflow_id' => 'string',
        'status' => '\Gisl\Generated\OpenApi\Model\WorkflowStatus',
        'created_at' => '\DateTime',
        'updated_at' => '\DateTime',
        'jobs' => '\Gisl\Generated\OpenApi\Model\JobResponse[]',
        'paused_detail' => '\Gisl\Generated\OpenApi\Model\WorkflowPausedDetail',
        'composition_plan' => '\Gisl\Generated\OpenApi\Model\CompositionPlan',
        'credits' => '\Gisl\Generated\OpenApi\Model\WorkflowCreditSummary',
        'codegen_source' => '\Gisl\Generated\OpenApi\Model\CodegenSource'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'workflow_id' => 'uuid',
        'status' => null,
        'created_at' => 'date-time',
        'updated_at' => 'date-time',
        'jobs' => null,
        'paused_detail' => null,
        'composition_plan' => null,
        'credits' => null,
        'codegen_source' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'workflow_id' => false,
        'status' => false,
        'created_at' => false,
        'updated_at' => false,
        'jobs' => false,
        'paused_detail' => false,
        'composition_plan' => false,
        'credits' => true,
        'codegen_source' => false
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
        'workflow_id' => 'workflow_id',
        'status' => 'status',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'jobs' => 'jobs',
        'paused_detail' => 'paused_detail',
        'composition_plan' => 'composition_plan',
        'credits' => 'credits',
        'codegen_source' => 'codegen_source'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'workflow_id' => 'setWorkflowId',
        'status' => 'setStatus',
        'created_at' => 'setCreatedAt',
        'updated_at' => 'setUpdatedAt',
        'jobs' => 'setJobs',
        'paused_detail' => 'setPausedDetail',
        'composition_plan' => 'setCompositionPlan',
        'credits' => 'setCredits',
        'codegen_source' => 'setCodegenSource'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'workflow_id' => 'getWorkflowId',
        'status' => 'getStatus',
        'created_at' => 'getCreatedAt',
        'updated_at' => 'getUpdatedAt',
        'jobs' => 'getJobs',
        'paused_detail' => 'getPausedDetail',
        'composition_plan' => 'getCompositionPlan',
        'credits' => 'getCredits',
        'codegen_source' => 'getCodegenSource'
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
        $this->setIfExists('workflow_id', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('updated_at', $data ?? [], null);
        $this->setIfExists('jobs', $data ?? [], null);
        $this->setIfExists('paused_detail', $data ?? [], null);
        $this->setIfExists('composition_plan', $data ?? [], null);
        $this->setIfExists('credits', $data ?? [], null);
        $this->setIfExists('codegen_source', $data ?? [], null);
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

        if ($this->container['workflow_id'] === null) {
            $invalidProperties[] = "'workflow_id' can't be null";
        }
        if (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['workflow_id'])) {
            $invalidProperties[] = "invalid value for 'workflow_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['updated_at'] === null) {
            $invalidProperties[] = "'updated_at' can't be null";
        }
        if ($this->container['jobs'] === null) {
            $invalidProperties[] = "'jobs' can't be null";
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
     * Gets workflow_id
     *
     * @return string
     */
    public function getWorkflowId()
    {
        return $this->container['workflow_id'];
    }

    /**
     * Sets workflow_id
     *
     * @param string $workflow_id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setWorkflowId($workflow_id)
    {
        if (is_null($workflow_id)) {
            throw new \InvalidArgumentException('non-nullable workflow_id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($workflow_id)))) {
            throw new \InvalidArgumentException("invalid value for \$workflow_id when calling WorkflowStatusResponse., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['workflow_id'] = $workflow_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \Gisl\Generated\OpenApi\Model\WorkflowStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \Gisl\Generated\OpenApi\Model\WorkflowStatus $status status
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
     * @param \DateTime $created_at ISO-8601 timestamp at which the workflow row was committed (matches `WorkflowCreateResponse.created_at` for the same workflow). Per ticket [0HFbi9kh](https://trello.com/c/0HFbi9kh).
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
     * Gets updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param \DateTime $updated_at ISO-8601 timestamp at which the workflow row was last updated server-side (status transition, terminal-event commit, paused/resumed state change, etc.). The API always emits this field; spec catches up to behaviour shipping since `WorkflowController.php:178-179`.
     *
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        if (is_null($updated_at)) {
            throw new \InvalidArgumentException('non-nullable updated_at cannot be null');
        }
        $this->container['updated_at'] = $updated_at;

        return $this;
    }

    /**
     * Gets jobs
     *
     * @return \Gisl\Generated\OpenApi\Model\JobResponse[]
     */
    public function getJobs()
    {
        return $this->container['jobs'];
    }

    /**
     * Sets jobs
     *
     * @param \Gisl\Generated\OpenApi\Model\JobResponse[] $jobs jobs
     *
     * @return self
     */
    public function setJobs($jobs)
    {
        if (is_null($jobs)) {
            throw new \InvalidArgumentException('non-nullable jobs cannot be null');
        }
        $this->container['jobs'] = $jobs;

        return $this;
    }

    /**
     * Gets paused_detail
     *
     * @return \Gisl\Generated\OpenApi\Model\WorkflowPausedDetail|null
     */
    public function getPausedDetail()
    {
        return $this->container['paused_detail'];
    }

    /**
     * Sets paused_detail
     *
     * @param \Gisl\Generated\OpenApi\Model\WorkflowPausedDetail|null $paused_detail Present only when `status = paused_insufficient_credits` (per ticket [I24](https://trello.com/c/e50uXLcl)). Carries `paused_at`, `expires_at`, `required_action`, and actionable `links` (resume / top_up / upgrade).
     *
     * @return self
     */
    public function setPausedDetail($paused_detail)
    {
        if (is_null($paused_detail)) {
            throw new \InvalidArgumentException('non-nullable paused_detail cannot be null');
        }
        $this->container['paused_detail'] = $paused_detail;

        return $this;
    }

    /**
     * Gets composition_plan
     *
     * @return \Gisl\Generated\OpenApi\Model\CompositionPlan|null
     */
    public function getCompositionPlan()
    {
        return $this->container['composition_plan'];
    }

    /**
     * Sets composition_plan
     *
     * @param \Gisl\Generated\OpenApi\Model\CompositionPlan|null $composition_plan Server-computed canonical composition plan, echoed on the status read so a frontend reload / resume can re-derive the canonicalized DAG (canonical order, per-op chain group/position, derived-artifact lineage, image-encode capabilities) without re-submitting. Identical shape and semantics to `WorkflowCreateResponse.composition_plan`.  **OPTIONAL (optional-then-promote).** The canonicalization engine that emits it ships in later phases of the operation-composition epic; the server omits the field until it is live (mirroring the create side). Per ticket [`RrxdUBGZ`](https://trello.com/c/RrxdUBGZ) / `i2J8AMy6`.
     *
     * @return self
     */
    public function setCompositionPlan($composition_plan)
    {
        if (is_null($composition_plan)) {
            throw new \InvalidArgumentException('non-nullable composition_plan cannot be null');
        }
        $this->container['composition_plan'] = $composition_plan;

        return $this;
    }

    /**
     * Gets credits
     *
     * @return \Gisl\Generated\OpenApi\Model\WorkflowCreditSummary|null
     */
    public function getCredits()
    {
        return $this->container['credits'];
    }

    /**
     * Sets credits
     *
     * @param \Gisl\Generated\OpenApi\Model\WorkflowCreditSummary|null $credits credits
     *
     * @return self
     */
    public function setCredits($credits)
    {
        if (is_null($credits)) {
            array_push($this->openAPINullablesSetToNull, 'credits');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('credits', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['credits'] = $credits;

        return $this;
    }

    /**
     * Gets codegen_source
     *
     * @return \Gisl\Generated\OpenApi\Model\CodegenSource|null
     */
    public function getCodegenSource()
    {
        return $this->container['codegen_source'];
    }

    /**
     * Sets codegen_source
     *
     * @param \Gisl\Generated\OpenApi\Model\CodegenSource|null $codegen_source OPTIONAL, drill-in-only \"code for this run\" / replay projection — the allowlisted, re-submittable shape of the original request (for an SDK snippet / \"run it again\"). Absent until the API populates it. NOT a dump of the persisted option bag; see `CodegenSource`. Per ticket `LO0R5gzk`.
     *
     * @return self
     */
    public function setCodegenSource($codegen_source)
    {
        if (is_null($codegen_source)) {
            throw new \InvalidArgumentException('non-nullable codegen_source cannot be null');
        }
        $this->container['codegen_source'] = $codegen_source;

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


