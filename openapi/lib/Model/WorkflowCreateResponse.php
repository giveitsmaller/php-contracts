<?php
/**
 * WorkflowCreateResponse
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
 * The version of the OpenAPI document: 2.152.0
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
 * WorkflowCreateResponse Class Doc Comment
 *
 * @category Class
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class WorkflowCreateResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'WorkflowCreateResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'workflow_id' => 'string',
        'status' => '\Gisl\Generated\OpenApi\Model\WorkflowStatus',
        'created_at' => '\DateTime',
        'jobs' => '\Gisl\Generated\OpenApi\Model\JobResponse[]',
        'delivery_plan' => '\Gisl\Generated\OpenApi\Model\DeliveryPlan',
        'processing_plan' => '\Gisl\Generated\OpenApi\Model\ProcessingPlan',
        'composition_plan' => '\Gisl\Generated\OpenApi\Model\CompositionPlan',
        'warnings' => '\Gisl\Generated\OpenApi\Model\WorkflowWarning[]',
        'webhook_secret' => 'string',
        'cap' => 'string'
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
        'jobs' => null,
        'delivery_plan' => null,
        'processing_plan' => null,
        'composition_plan' => null,
        'warnings' => null,
        'webhook_secret' => null,
        'cap' => null
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
        'jobs' => false,
        'delivery_plan' => false,
        'processing_plan' => false,
        'composition_plan' => false,
        'warnings' => false,
        'webhook_secret' => true,
        'cap' => true
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
        'jobs' => 'jobs',
        'delivery_plan' => 'delivery_plan',
        'processing_plan' => 'processing_plan',
        'composition_plan' => 'composition_plan',
        'warnings' => 'warnings',
        'webhook_secret' => 'webhook_secret',
        'cap' => 'cap'
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
        'jobs' => 'setJobs',
        'delivery_plan' => 'setDeliveryPlan',
        'processing_plan' => 'setProcessingPlan',
        'composition_plan' => 'setCompositionPlan',
        'warnings' => 'setWarnings',
        'webhook_secret' => 'setWebhookSecret',
        'cap' => 'setCap'
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
        'jobs' => 'getJobs',
        'delivery_plan' => 'getDeliveryPlan',
        'processing_plan' => 'getProcessingPlan',
        'composition_plan' => 'getCompositionPlan',
        'warnings' => 'getWarnings',
        'webhook_secret' => 'getWebhookSecret',
        'cap' => 'getCap'
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
        $this->setIfExists('jobs', $data ?? [], null);
        $this->setIfExists('delivery_plan', $data ?? [], null);
        $this->setIfExists('processing_plan', $data ?? [], null);
        $this->setIfExists('composition_plan', $data ?? [], null);
        $this->setIfExists('warnings', $data ?? [], null);
        $this->setIfExists('webhook_secret', $data ?? [], null);
        $this->setIfExists('cap', $data ?? [], null);
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
        if ($this->container['jobs'] === null) {
            $invalidProperties[] = "'jobs' can't be null";
        }
        if ($this->container['delivery_plan'] === null) {
            $invalidProperties[] = "'delivery_plan' can't be null";
        }
        if ($this->container['processing_plan'] === null) {
            $invalidProperties[] = "'processing_plan' can't be null";
        }
        if ($this->container['warnings'] === null) {
            $invalidProperties[] = "'warnings' can't be null";
        }
        if (!is_null($this->container['webhook_secret']) && (mb_strlen($this->container['webhook_secret']) > 64)) {
            $invalidProperties[] = "invalid value for 'webhook_secret', the character length must be smaller than or equal to 64.";
        }

        if (!is_null($this->container['webhook_secret']) && (mb_strlen($this->container['webhook_secret']) < 64)) {
            $invalidProperties[] = "invalid value for 'webhook_secret', the character length must be bigger than or equal to 64.";
        }

        if (!is_null($this->container['webhook_secret']) && !preg_match("/^[0-9a-f]{64}$/", $this->container['webhook_secret'])) {
            $invalidProperties[] = "invalid value for 'webhook_secret', must be conform to the pattern /^[0-9a-f]{64}$/.";
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
            throw new \InvalidArgumentException("invalid value for \$workflow_id when calling WorkflowCreateResponse., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
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
     * @param \DateTime $created_at ISO-8601 timestamp at which the workflow row was committed to the database (per ticket [Z1GEw5nG](https://trello.com/c/Z1GEw5nG)). The API always emits this field; spec catches up to behaviour shipping since `WorkflowController.php:147`.
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
     * Gets delivery_plan
     *
     * @return \Gisl\Generated\OpenApi\Model\DeliveryPlan
     */
    public function getDeliveryPlan()
    {
        return $this->container['delivery_plan'];
    }

    /**
     * Sets delivery_plan
     *
     * @param \Gisl\Generated\OpenApi\Model\DeliveryPlan $delivery_plan Server-computed delivery plan per [ADR-0003](../docs/decisions/0003-delivery-mode.md). Always present (V2 cutover invariant); server emits empty `outputs: []` / `hidden_outputs: []` when applicable rather than omitting the field.
     *
     * @return self
     */
    public function setDeliveryPlan($delivery_plan)
    {
        if (is_null($delivery_plan)) {
            throw new \InvalidArgumentException('non-nullable delivery_plan cannot be null');
        }
        $this->container['delivery_plan'] = $delivery_plan;

        return $this;
    }

    /**
     * Gets processing_plan
     *
     * @return \Gisl\Generated\OpenApi\Model\ProcessingPlan
     */
    public function getProcessingPlan()
    {
        return $this->container['processing_plan'];
    }

    /**
     * Sets processing_plan
     *
     * @param \Gisl\Generated\OpenApi\Model\ProcessingPlan $processing_plan Server-computed processing plan per ticket [I15-CONS](https://trello.com/c/YZpBKzOM) — F8 long-form video tier. Always present (V2 cutover invariant — mirrors `delivery_plan`); server emits `jobs: []` when the workflow has no compute jobs (e.g. archive-only) rather than omitting the field. Per-job entries surface `processing_class`, opaque `execution_pool` for display, and rough queue/processing time estimates so the frontend can preview routing decisions before the workflow runs. Estimation algorithm is server-side and deliberately opaque per plan v5 §F8.2.
     *
     * @return self
     */
    public function setProcessingPlan($processing_plan)
    {
        if (is_null($processing_plan)) {
            throw new \InvalidArgumentException('non-nullable processing_plan cannot be null');
        }
        $this->container['processing_plan'] = $processing_plan;

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
     * @param \Gisl\Generated\OpenApi\Model\CompositionPlan|null $composition_plan Server-computed canonical composition plan — the single source of truth for how the submitted operation **set** was canonicalized into a deterministic DAG (canonical order, per-op chain group/position, derived-artifact lineage, and image-encode capabilities). Frontend + SDK read this instead of hardcoding the pipeline order (which today lives only in the API), so click-order never changes the result.  **OPTIONAL (optional-then-promote).** The canonicalization engine that emits it ships in later phases of the operation-composition epic; until it is live the server omits this field rather than emitting a partial plan. Promoted to required once the engine emits reliably (the same optional-then-promote path `delivery_plan` / `processing_plan` took). Consumers MUST treat it as may-be-absent.
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
     * Gets warnings
     *
     * @return \Gisl\Generated\OpenApi\Model\WorkflowWarning[]
     */
    public function getWarnings()
    {
        return $this->container['warnings'];
    }

    /**
     * Sets warnings
     *
     * @param \Gisl\Generated\OpenApi\Model\WorkflowWarning[] $warnings Advisory non-blocking warnings detected at workflow-create time per ticket [I25 `i5yCuSZc`](https://trello.com/c/i5yCuSZc) + plan v5 §F11. Always present (V2 cutover invariant — mirrors `delivery_plan` / `processing_plan`); server emits empty `[]` when no warnings detected. Workflow proceeds regardless — warnings do not block dispatch.  SDKs MUST treat the `warning_type` enum as additive — ignore unknown values encountered at runtime (forward-compatible convention; same precedent as `ProgressStatus`, `ProcessingClassReason`, `WorkflowStatus`).
     *
     * @return self
     */
    public function setWarnings($warnings)
    {
        if (is_null($warnings)) {
            throw new \InvalidArgumentException('non-nullable warnings cannot be null');
        }
        $this->container['warnings'] = $warnings;

        return $this;
    }

    /**
     * Gets webhook_secret
     *
     * @return string|null
     */
    public function getWebhookSecret()
    {
        return $this->container['webhook_secret'];
    }

    /**
     * Sets webhook_secret
     *
     * @param string|null $webhook_secret HMAC-SHA256 signing key for webhook verification. Present only when `callback_url` was provided in the request. This is the only time the secret is exposed — it does not appear in status queries.  Use this key to verify the `X-GIS-Signature` header on incoming webhook requests: `sha256=<hex(hmac-sha256(webhook_secret, raw_body))>`.
     *
     * @return self
     */
    public function setWebhookSecret($webhook_secret)
    {
        if (is_null($webhook_secret)) {
            array_push($this->openAPINullablesSetToNull, 'webhook_secret');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('webhook_secret', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($webhook_secret) && (mb_strlen($webhook_secret) > 64)) {
            throw new \InvalidArgumentException('invalid length for $webhook_secret when calling WorkflowCreateResponse., must be smaller than or equal to 64.');
        }
        if (!is_null($webhook_secret) && (mb_strlen($webhook_secret) < 64)) {
            throw new \InvalidArgumentException('invalid length for $webhook_secret when calling WorkflowCreateResponse., must be bigger than or equal to 64.');
        }
        if (!is_null($webhook_secret) && (!preg_match("/^[0-9a-f]{64}$/", ObjectSerializer::toString($webhook_secret)))) {
            throw new \InvalidArgumentException("invalid value for \$webhook_secret when calling WorkflowCreateResponse., must conform to the pattern /^[0-9a-f]{64}$/.");
        }

        $this->container['webhook_secret'] = $webhook_secret;

        return $this;
    }

    /**
     * Gets cap
     *
     * @return string|null
     */
    public function getCap()
    {
        return $this->container['cap'];
    }

    /**
     * Sets cap
     *
     * @param string|null $cap Per-workflow capability token (plaintext). Present ONLY for an **anonymous (null-owner)** workflow create — it is the bearer that authorizes reads of this workflow without a session. ABSENT for authenticated creates (the session authorizes those). Like `webhook_secret`, this is the only time it is exposed; it does not appear in status queries.  Pass it as the `X-Workflow-Capability` request header on `GET /api/workflows/{id}/status` / `/downloads` / `/events`. A wrong or missing cap on a null-owner workflow returns **404** (`WorkflowNotFound`) — deliberately no existence oracle (not 401/403). Per ticket [`YQt88cq2`](https://trello.com/c/YQt88cq2).
     *
     * @return self
     */
    public function setCap($cap)
    {
        if (is_null($cap)) {
            array_push($this->openAPINullablesSetToNull, 'cap');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('cap', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['cap'] = $cap;

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


