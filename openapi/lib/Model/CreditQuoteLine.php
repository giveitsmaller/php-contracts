<?php
/**
 * CreditQuoteLine
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
 * The version of the OpenAPI document: 2.251.0
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
 * CreditQuoteLine Class Doc Comment
 *
 * @category Class
 * @description One canonical operation node of one public job, with its ceiling and where its credits are. Settlement grain is the PUBLIC JOB: a job&#39;s lines settle together, except an already-optimal compress, which is settled per operation. Invariant: &#x60;charged_credits + released_credits &lt;&#x3D; max_credits&#x60;, with equality once the quote is &#x60;final&#x60;.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreditQuoteLine implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CreditQuoteLine';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'line_id' => 'string',
        'job_ref' => 'string',
        'operation_index' => 'int',
        'operation_type' => '\Gisl\Generated\OpenApi\Model\OperationType',
        'requested_operations' => '\Gisl\Generated\OpenApi\Model\OperationType[]',
        'job_id' => 'string',
        'operation_id' => 'string',
        'max_credits' => 'int',
        'state' => '\Gisl\Generated\OpenApi\Model\CreditQuoteLineState',
        'outcome' => '\Gisl\Generated\OpenApi\Model\CreditQuoteLineOutcome',
        'charged_credits' => 'int',
        'released_credits' => 'int',
        'cost_parts' => '\Gisl\Generated\OpenApi\Model\CreditQuoteLineCostParts'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'line_id' => null,
        'job_ref' => null,
        'operation_index' => null,
        'operation_type' => null,
        'requested_operations' => null,
        'job_id' => 'uuid',
        'operation_id' => 'uuid',
        'max_credits' => null,
        'state' => null,
        'outcome' => null,
        'charged_credits' => null,
        'released_credits' => null,
        'cost_parts' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'line_id' => false,
        'job_ref' => false,
        'operation_index' => false,
        'operation_type' => false,
        'requested_operations' => false,
        'job_id' => true,
        'operation_id' => true,
        'max_credits' => false,
        'state' => false,
        'outcome' => false,
        'charged_credits' => false,
        'released_credits' => false,
        'cost_parts' => true
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
        'line_id' => 'line_id',
        'job_ref' => 'job_ref',
        'operation_index' => 'operation_index',
        'operation_type' => 'operation_type',
        'requested_operations' => 'requested_operations',
        'job_id' => 'job_id',
        'operation_id' => 'operation_id',
        'max_credits' => 'max_credits',
        'state' => 'state',
        'outcome' => 'outcome',
        'charged_credits' => 'charged_credits',
        'released_credits' => 'released_credits',
        'cost_parts' => 'cost_parts'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'line_id' => 'setLineId',
        'job_ref' => 'setJobRef',
        'operation_index' => 'setOperationIndex',
        'operation_type' => 'setOperationType',
        'requested_operations' => 'setRequestedOperations',
        'job_id' => 'setJobId',
        'operation_id' => 'setOperationId',
        'max_credits' => 'setMaxCredits',
        'state' => 'setState',
        'outcome' => 'setOutcome',
        'charged_credits' => 'setChargedCredits',
        'released_credits' => 'setReleasedCredits',
        'cost_parts' => 'setCostParts'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'line_id' => 'getLineId',
        'job_ref' => 'getJobRef',
        'operation_index' => 'getOperationIndex',
        'operation_type' => 'getOperationType',
        'requested_operations' => 'getRequestedOperations',
        'job_id' => 'getJobId',
        'operation_id' => 'getOperationId',
        'max_credits' => 'getMaxCredits',
        'state' => 'getState',
        'outcome' => 'getOutcome',
        'charged_credits' => 'getChargedCredits',
        'released_credits' => 'getReleasedCredits',
        'cost_parts' => 'getCostParts'
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
        $this->setIfExists('line_id', $data ?? [], null);
        $this->setIfExists('job_ref', $data ?? [], null);
        $this->setIfExists('operation_index', $data ?? [], null);
        $this->setIfExists('operation_type', $data ?? [], null);
        $this->setIfExists('requested_operations', $data ?? [], null);
        $this->setIfExists('job_id', $data ?? [], null);
        $this->setIfExists('operation_id', $data ?? [], null);
        $this->setIfExists('max_credits', $data ?? [], null);
        $this->setIfExists('state', $data ?? [], null);
        $this->setIfExists('outcome', $data ?? [], null);
        $this->setIfExists('charged_credits', $data ?? [], null);
        $this->setIfExists('released_credits', $data ?? [], null);
        $this->setIfExists('cost_parts', $data ?? [], null);
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

        if ($this->container['line_id'] === null) {
            $invalidProperties[] = "'line_id' can't be null";
        }
        if (!preg_match("/^[A-Za-z][A-Za-z0-9_-]*\/(0|[1-9][0-9]*)$/", $this->container['line_id'])) {
            $invalidProperties[] = "invalid value for 'line_id', must be conform to the pattern /^[A-Za-z][A-Za-z0-9_-]*\/(0|[1-9][0-9]*)$/.";
        }

        if ($this->container['job_ref'] === null) {
            $invalidProperties[] = "'job_ref' can't be null";
        }
        if (!preg_match("/^[A-Za-z][A-Za-z0-9_-]*$/", $this->container['job_ref'])) {
            $invalidProperties[] = "invalid value for 'job_ref', must be conform to the pattern /^[A-Za-z][A-Za-z0-9_-]*$/.";
        }

        if ($this->container['operation_index'] === null) {
            $invalidProperties[] = "'operation_index' can't be null";
        }
        if (($this->container['operation_index'] < 0)) {
            $invalidProperties[] = "invalid value for 'operation_index', must be bigger than or equal to 0.";
        }

        if ($this->container['operation_type'] === null) {
            $invalidProperties[] = "'operation_type' can't be null";
        }
        if (!is_null($this->container['job_id']) && !preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['job_id'])) {
            $invalidProperties[] = "invalid value for 'job_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if (!is_null($this->container['operation_id']) && !preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['operation_id'])) {
            $invalidProperties[] = "invalid value for 'operation_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['max_credits'] === null) {
            $invalidProperties[] = "'max_credits' can't be null";
        }
        if (($this->container['max_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'max_credits', must be bigger than or equal to 0.";
        }

        if ($this->container['state'] === null) {
            $invalidProperties[] = "'state' can't be null";
        }
        if ($this->container['charged_credits'] === null) {
            $invalidProperties[] = "'charged_credits' can't be null";
        }
        if (($this->container['charged_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'charged_credits', must be bigger than or equal to 0.";
        }

        if ($this->container['released_credits'] === null) {
            $invalidProperties[] = "'released_credits' can't be null";
        }
        if (($this->container['released_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'released_credits', must be bigger than or equal to 0.";
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
     * Gets line_id
     *
     * @return string
     */
    public function getLineId()
    {
        return $this->container['line_id'];
    }

    /**
     * Sets line_id
     *
     * @param string $line_id `<job_ref>/<operation_index>`. Stable for the life of the workflow: a retry, a resume and a re-quote keep it.
     *
     * @return self
     */
    public function setLineId($line_id)
    {
        if (is_null($line_id)) {
            throw new \InvalidArgumentException('non-nullable line_id cannot be null');
        }

        if ((!preg_match("/^[A-Za-z][A-Za-z0-9_-]*\/(0|[1-9][0-9]*)$/", ObjectSerializer::toString($line_id)))) {
            throw new \InvalidArgumentException("invalid value for \$line_id when calling CreditQuoteLine., must conform to the pattern /^[A-Za-z][A-Za-z0-9_-]*\/(0|[1-9][0-9]*)$/.");
        }

        $this->container['line_id'] = $line_id;

        return $this;
    }

    /**
     * Gets job_ref
     *
     * @return string
     */
    public function getJobRef()
    {
        return $this->container['job_ref'];
    }

    /**
     * Sets job_ref
     *
     * @param string $job_ref The job's `JobDefinition.id`, or `job_<n>` (the job's 0-based position in the request) when the request gave none.
     *
     * @return self
     */
    public function setJobRef($job_ref)
    {
        if (is_null($job_ref)) {
            throw new \InvalidArgumentException('non-nullable job_ref cannot be null');
        }

        if ((!preg_match("/^[A-Za-z][A-Za-z0-9_-]*$/", ObjectSerializer::toString($job_ref)))) {
            throw new \InvalidArgumentException("invalid value for \$job_ref when calling CreditQuoteLine., must conform to the pattern /^[A-Za-z][A-Za-z0-9_-]*$/.");
        }

        $this->container['job_ref'] = $job_ref;

        return $this;
    }

    /**
     * Gets operation_index
     *
     * @return int
     */
    public function getOperationIndex()
    {
        return $this->container['operation_index'];
    }

    /**
     * Sets operation_index
     *
     * @param int $operation_index Position of this node in the job's PUBLIC canonical chain (`composition_plan` order), starting at 0.
     *
     * @return self
     */
    public function setOperationIndex($operation_index)
    {
        if (is_null($operation_index)) {
            throw new \InvalidArgumentException('non-nullable operation_index cannot be null');
        }

        if (($operation_index < 0)) {
            throw new \InvalidArgumentException('invalid value for $operation_index when calling CreditQuoteLine., must be bigger than or equal to 0.');
        }

        $this->container['operation_index'] = $operation_index;

        return $this;
    }

    /**
     * Gets operation_type
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationType
     */
    public function getOperationType()
    {
        return $this->container['operation_type'];
    }

    /**
     * Sets operation_type
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationType $operation_type operation_type
     *
     * @return self
     */
    public function setOperationType($operation_type)
    {
        if (is_null($operation_type)) {
            throw new \InvalidArgumentException('non-nullable operation_type cannot be null');
        }
        $this->container['operation_type'] = $operation_type;

        return $this;
    }

    /**
     * Gets requested_operations
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationType[]|null
     */
    public function getRequestedOperations()
    {
        return $this->container['requested_operations'];
    }

    /**
     * Sets requested_operations
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationType[]|null $requested_operations The submitted operations folded into this canonical node (for example a `convert` and a `compress` that run as one encode).
     *
     * @return self
     */
    public function setRequestedOperations($requested_operations)
    {
        if (is_null($requested_operations)) {
            throw new \InvalidArgumentException('non-nullable requested_operations cannot be null');
        }
        $this->container['requested_operations'] = $requested_operations;

        return $this;
    }

    /**
     * Gets job_id
     *
     * @return string|null
     */
    public function getJobId()
    {
        return $this->container['job_id'];
    }

    /**
     * Sets job_id
     *
     * @param string|null $job_id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setJobId($job_id)
    {
        if (is_null($job_id)) {
            array_push($this->openAPINullablesSetToNull, 'job_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('job_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($job_id) && (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($job_id)))) {
            throw new \InvalidArgumentException("invalid value for \$job_id when calling CreditQuoteLine., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['job_id'] = $job_id;

        return $this;
    }

    /**
     * Gets operation_id
     *
     * @return string|null
     */
    public function getOperationId()
    {
        return $this->container['operation_id'];
    }

    /**
     * Sets operation_id
     *
     * @param string|null $operation_id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setOperationId($operation_id)
    {
        if (is_null($operation_id)) {
            array_push($this->openAPINullablesSetToNull, 'operation_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('operation_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($operation_id) && (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($operation_id)))) {
            throw new \InvalidArgumentException("invalid value for \$operation_id when calling CreditQuoteLine., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['operation_id'] = $operation_id;

        return $this;
    }

    /**
     * Gets max_credits
     *
     * @return int
     */
    public function getMaxCredits()
    {
        return $this->container['max_credits'];
    }

    /**
     * Sets max_credits
     *
     * @param int $max_credits The most this line can be charged, including the per-operation input-size surcharge. Never rises after acceptance.
     *
     * @return self
     */
    public function setMaxCredits($max_credits)
    {
        if (is_null($max_credits)) {
            throw new \InvalidArgumentException('non-nullable max_credits cannot be null');
        }

        if (($max_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $max_credits when calling CreditQuoteLine., must be bigger than or equal to 0.');
        }

        $this->container['max_credits'] = $max_credits;

        return $this;
    }

    /**
     * Gets state
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteLineState
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteLineState $state state
     *
     * @return self
     */
    public function setState($state)
    {
        if (is_null($state)) {
            throw new \InvalidArgumentException('non-nullable state cannot be null');
        }
        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets outcome
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteLineOutcome|null
     */
    public function getOutcome()
    {
        return $this->container['outcome'];
    }

    /**
     * Sets outcome
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteLineOutcome|null $outcome outcome
     *
     * @return self
     */
    public function setOutcome($outcome)
    {
        if (is_null($outcome)) {
            throw new \InvalidArgumentException('non-nullable outcome cannot be null');
        }
        $this->container['outcome'] = $outcome;

        return $this;
    }

    /**
     * Gets charged_credits
     *
     * @return int
     */
    public function getChargedCredits()
    {
        return $this->container['charged_credits'];
    }

    /**
     * Sets charged_credits
     *
     * @param int $charged_credits Credits charged on this line.
     *
     * @return self
     */
    public function setChargedCredits($charged_credits)
    {
        if (is_null($charged_credits)) {
            throw new \InvalidArgumentException('non-nullable charged_credits cannot be null');
        }

        if (($charged_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $charged_credits when calling CreditQuoteLine., must be bigger than or equal to 0.');
        }

        $this->container['charged_credits'] = $charged_credits;

        return $this;
    }

    /**
     * Gets released_credits
     *
     * @return int
     */
    public function getReleasedCredits()
    {
        return $this->container['released_credits'];
    }

    /**
     * Sets released_credits
     *
     * @param int $released_credits Credits of this line released for good.
     *
     * @return self
     */
    public function setReleasedCredits($released_credits)
    {
        if (is_null($released_credits)) {
            throw new \InvalidArgumentException('non-nullable released_credits cannot be null');
        }

        if (($released_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $released_credits when calling CreditQuoteLine., must be bigger than or equal to 0.');
        }

        $this->container['released_credits'] = $released_credits;

        return $this;
    }

    /**
     * Gets cost_parts
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteLineCostParts|null
     */
    public function getCostParts()
    {
        return $this->container['cost_parts'];
    }

    /**
     * Sets cost_parts
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteLineCostParts|null $cost_parts cost_parts
     *
     * @return self
     */
    public function setCostParts($cost_parts)
    {
        if (is_null($cost_parts)) {
            array_push($this->openAPINullablesSetToNull, 'cost_parts');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('cost_parts', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['cost_parts'] = $cost_parts;

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


