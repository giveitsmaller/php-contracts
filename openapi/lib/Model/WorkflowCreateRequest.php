<?php
/**
 * WorkflowCreateRequest
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
 * The version of the OpenAPI document: 2.158.0
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
 * WorkflowCreateRequest Class Doc Comment
 *
 * @category Class
 * @description Create a workflow. **Two mutually-exclusive request forms:**  - **Explicit jobs** — &#x60;jobs[]&#x60; (+ optional &#x60;workflow_edges&#x60;), the   full multi-job DAG form. Use for multi-job workflows, role-based   / multi-input operations, output-as-role-input chains, explicit   edges, or &#x60;delivery.selection.type: explicit&#x60;. - **Flat (single-job sugar)** — top-level &#x60;source&#x60; + &#x60;operations[]&#x60;,   **exactly equivalent to &#x60;jobs: [{ source, operations }]&#x60;** (per   ticket [&#x60;D0Gsri8V&#x60;](https://trello.com/c/D0Gsri8V)). The server   lowers it into one &#x60;JobDefinition&#x60; and validates it as such —   inheriting every &#x60;JobDefinition&#x60; guard verbatim — then runs the   existing single-job canonicalizer. For the file-first   dump-and-go case: one input + a set of single-input operations   (a chain plus &#x60;base&#x60;-derived branches like thumbnail / split).  The two forms are mutually exclusive (a request supplies exactly one — enforced by the &#x60;oneOf&#x60; below); they are NOT combined.  Because the flat form lowers to ONE single-input job, its &#x60;operations[]&#x60; admits only **single-input** operation types. The multi-input / role operations (&#x60;merge&#x60;, &#x60;archive&#x60;, &#x60;image_watermark&#x60;, &#x60;custom_luma&#x60;, &#x60;audio_overlay&#x60;, &#x60;audio_to_video&#x60;, &#x60;video_watermark&#x60; — the enum at the &#x60;JobDefinition&#x60; multi-input guard) require &#x60;inputs[]&#x60; and MUST use the explicit &#x60;jobs[]&#x60; form; the server rejects them in flat mode via that same &#x60;JobDefinition&#x60; guard after lowering (not a separate structural rule). The flat form also does **not** support &#x60;workflow_edges&#x60; or &#x60;delivery.selection.type: explicit&#x60; — both need a named job id the single implicit job has none of; use explicit &#x60;jobs[]&#x60; for those. Delivery defaults and selection otherwise behave exactly as for one explicit job.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class WorkflowCreateRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'WorkflowCreateRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'jobs' => '\Gisl\Generated\OpenApi\Model\JobDefinition[]',
        'source' => '\Gisl\Generated\OpenApi\Model\WorkflowSource',
        'operations' => '\Gisl\Generated\OpenApi\Model\OperationDefinition[]',
        'workflow_edges' => '\Gisl\Generated\OpenApi\Model\WorkflowEdge[]',
        'callback_url' => 'string',
        'callback_events' => '\Gisl\Generated\OpenApi\Model\CallbackEventType[]',
        'export' => '\Gisl\Generated\OpenApi\Model\ExternalDestination',
        'delivery' => '\Gisl\Generated\OpenApi\Model\Delivery',
        'processing' => '\Gisl\Generated\OpenApi\Model\WorkflowProcessing'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'jobs' => null,
        'source' => null,
        'operations' => null,
        'workflow_edges' => null,
        'callback_url' => 'uri',
        'callback_events' => null,
        'export' => null,
        'delivery' => null,
        'processing' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'jobs' => false,
        'source' => false,
        'operations' => false,
        'workflow_edges' => false,
        'callback_url' => true,
        'callback_events' => false,
        'export' => false,
        'delivery' => false,
        'processing' => false
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
        'jobs' => 'jobs',
        'source' => 'source',
        'operations' => 'operations',
        'workflow_edges' => 'workflow_edges',
        'callback_url' => 'callback_url',
        'callback_events' => 'callback_events',
        'export' => 'export',
        'delivery' => 'delivery',
        'processing' => 'processing'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'jobs' => 'setJobs',
        'source' => 'setSource',
        'operations' => 'setOperations',
        'workflow_edges' => 'setWorkflowEdges',
        'callback_url' => 'setCallbackUrl',
        'callback_events' => 'setCallbackEvents',
        'export' => 'setExport',
        'delivery' => 'setDelivery',
        'processing' => 'setProcessing'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'jobs' => 'getJobs',
        'source' => 'getSource',
        'operations' => 'getOperations',
        'workflow_edges' => 'getWorkflowEdges',
        'callback_url' => 'getCallbackUrl',
        'callback_events' => 'getCallbackEvents',
        'export' => 'getExport',
        'delivery' => 'getDelivery',
        'processing' => 'getProcessing'
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
        $this->setIfExists('jobs', $data ?? [], null);
        $this->setIfExists('source', $data ?? [], null);
        $this->setIfExists('operations', $data ?? [], null);
        $this->setIfExists('workflow_edges', $data ?? [], null);
        $this->setIfExists('callback_url', $data ?? [], null);
        $this->setIfExists('callback_events', $data ?? [], null);
        $this->setIfExists('export', $data ?? [], null);
        $this->setIfExists('delivery', $data ?? [], null);
        $this->setIfExists('processing', $data ?? [], null);
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

        if (!is_null($this->container['jobs']) && (count($this->container['jobs']) < 1)) {
            $invalidProperties[] = "invalid value for 'jobs', number of items must be greater than or equal to 1.";
        }

        if (!is_null($this->container['operations']) && (count($this->container['operations']) < 1)) {
            $invalidProperties[] = "invalid value for 'operations', number of items must be greater than or equal to 1.";
        }

        if (!is_null($this->container['callback_url']) && !preg_match("/^https:\/\//", $this->container['callback_url'])) {
            $invalidProperties[] = "invalid value for 'callback_url', must be conform to the pattern /^https:\/\//.";
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
     * Gets jobs
     *
     * @return \Gisl\Generated\OpenApi\Model\JobDefinition[]|null
     */
    public function getJobs()
    {
        return $this->container['jobs'];
    }

    /**
     * Sets jobs
     *
     * @param \Gisl\Generated\OpenApi\Model\JobDefinition[]|null $jobs List of jobs in this workflow (the explicit-jobs form). Mutually exclusive with the flat `source` + `operations` form — supply exactly one.
     *
     * @return self
     */
    public function setJobs($jobs)
    {
        if (is_null($jobs)) {
            throw new \InvalidArgumentException('non-nullable jobs cannot be null');
        }


        if ((count($jobs) < 1)) {
            throw new \InvalidArgumentException('invalid length for $jobs when calling WorkflowCreateRequest., number of items must be greater than or equal to 1.');
        }
        $this->container['jobs'] = $jobs;

        return $this;
    }

    /**
     * Gets source
     *
     * @return \Gisl\Generated\OpenApi\Model\WorkflowSource|null
     */
    public function getSource()
    {
        return $this->container['source'];
    }

    /**
     * Sets source
     *
     * @param \Gisl\Generated\OpenApi\Model\WorkflowSource|null $source Flat-form single input source. Present only in the flat form (with `operations`); equivalent to a single explicit job's `source`. Single-input `WorkflowSource` (4-leaf union incl. `upload`) — multi-input role-based jobs use explicit `jobs[].inputs[]`. See the schema description for the flat/explicit mutex.
     *
     * @return self
     */
    public function setSource($source)
    {
        if (is_null($source)) {
            throw new \InvalidArgumentException('non-nullable source cannot be null');
        }
        $this->container['source'] = $source;

        return $this;
    }

    /**
     * Gets operations
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationDefinition[]|null
     */
    public function getOperations()
    {
        return $this->container['operations'];
    }

    /**
     * Sets operations
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationDefinition[]|null $operations Flat-form operation set (the unordered operations applied to the top-level `source`). Present only in the flat form (with `source`); equivalent to a single explicit job's `operations[]` and lowered + canonicalized identically. Single-input operation types only (see the schema description). Each entry is an `OperationDefinition`.
     *
     * @return self
     */
    public function setOperations($operations)
    {
        if (is_null($operations)) {
            throw new \InvalidArgumentException('non-nullable operations cannot be null');
        }


        if ((count($operations) < 1)) {
            throw new \InvalidArgumentException('invalid length for $operations when calling WorkflowCreateRequest., number of items must be greater than or equal to 1.');
        }
        $this->container['operations'] = $operations;

        return $this;
    }

    /**
     * Gets workflow_edges
     *
     * @return \Gisl\Generated\OpenApi\Model\WorkflowEdge[]|null
     */
    public function getWorkflowEdges()
    {
        return $this->container['workflow_edges'];
    }

    /**
     * Sets workflow_edges
     *
     * @param \Gisl\Generated\OpenApi\Model\WorkflowEdge[]|null $workflow_edges DAG dependency edges between jobs. Each edge defines that a downstream job depends on an upstream job's output. Jobs with no incoming edges start immediately. Jobs with dependencies wait for all upstream jobs.
     *
     * @return self
     */
    public function setWorkflowEdges($workflow_edges)
    {
        if (is_null($workflow_edges)) {
            throw new \InvalidArgumentException('non-nullable workflow_edges cannot be null');
        }
        $this->container['workflow_edges'] = $workflow_edges;

        return $this;
    }

    /**
     * Gets callback_url
     *
     * @return string|null
     */
    public function getCallbackUrl()
    {
        return $this->container['callback_url'];
    }

    /**
     * Sets callback_url
     *
     * @param string|null $callback_url Webhook URL (HTTPS only). The API POSTs a `WebhookPayload` JSON body to this URL when matching events occur. The payload includes event type, delivery ID, timestamp, and full workflow state with job results and download URLs. Must use HTTPS to prevent credential leakage and SSRF against internal endpoints.  **Signature verification:** Each request includes an `X-GIS-Signature` header containing an HMAC-SHA256 hex digest of the raw request body, using the per-workflow `webhook_secret` (returned in the workflow creation response) as the key. Header format: `sha256=<hex(hmac-sha256(webhook_secret, raw_body))>`. Consumers MUST verify the signature before processing the payload.
     *
     * @return self
     */
    public function setCallbackUrl($callback_url)
    {
        if (is_null($callback_url)) {
            array_push($this->openAPINullablesSetToNull, 'callback_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('callback_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($callback_url) && (!preg_match("/^https:\/\//", ObjectSerializer::toString($callback_url)))) {
            throw new \InvalidArgumentException("invalid value for \$callback_url when calling WorkflowCreateRequest., must conform to the pattern /^https:\/\//.");
        }

        $this->container['callback_url'] = $callback_url;

        return $this;
    }

    /**
     * Gets callback_events
     *
     * @return \Gisl\Generated\OpenApi\Model\CallbackEventType[]|null
     */
    public function getCallbackEvents()
    {
        return $this->container['callback_events'];
    }

    /**
     * Sets callback_events
     *
     * @param \Gisl\Generated\OpenApi\Model\CallbackEventType[]|null $callback_events Which events trigger the webhook callback. Defaults to terminal events only.
     *
     * @return self
     */
    public function setCallbackEvents($callback_events)
    {
        if (is_null($callback_events)) {
            throw new \InvalidArgumentException('non-nullable callback_events cannot be null');
        }
        $this->container['callback_events'] = $callback_events;

        return $this;
    }

    /**
     * Gets export
     *
     * @return \Gisl\Generated\OpenApi\Model\ExternalDestination|null
     */
    public function getExport()
    {
        return $this->container['export'];
    }

    /**
     * Sets export
     *
     * @param \Gisl\Generated\OpenApi\Model\ExternalDestination|null $export Optional V2 export destination. When set, all operation outputs are copied to the customer-controlled destination in addition to GISL's own S3 storage. Per ADR-0005, `ExternalDestination` shares shape family with `ExternalSource` but uses write-permission-based scoping. Replaces V1 `ExportConfig` (deleted at V2 cutover).
     *
     * @return self
     */
    public function setExport($export)
    {
        if (is_null($export)) {
            throw new \InvalidArgumentException('non-nullable export cannot be null');
        }
        $this->container['export'] = $export;

        return $this;
    }

    /**
     * Gets delivery
     *
     * @return \Gisl\Generated\OpenApi\Model\Delivery|null
     */
    public function getDelivery()
    {
        return $this->container['delivery'];
    }

    /**
     * Sets delivery
     *
     * @param \Gisl\Generated\OpenApi\Model\Delivery|null $delivery Optional workflow-level delivery configuration per [ADR-0003](../docs/decisions/0003-delivery-mode.md). When absent, the workflow defaults to `mode: individual, selection.type: terminal` (current V1 behaviour). Coexists with the `archive` operation — `archive` stays first-class for power-user cases (subset bundles, multi-bundle workflows, archive chaining, explicit folder/naming control).
     *
     * @return self
     */
    public function setDelivery($delivery)
    {
        if (is_null($delivery)) {
            throw new \InvalidArgumentException('non-nullable delivery cannot be null');
        }
        $this->container['delivery'] = $delivery;

        return $this;
    }

    /**
     * Gets processing
     *
     * @return \Gisl\Generated\OpenApi\Model\WorkflowProcessing|null
     */
    public function getProcessing()
    {
        return $this->container['processing'];
    }

    /**
     * Sets processing
     *
     * @param \Gisl\Generated\OpenApi\Model\WorkflowProcessing|null $processing Optional workflow-level processing hints per ticket [I15-CONS](https://trello.com/c/YZpBKzOM). Caller-supplied logical-policy hint via `processing.class_hint` (`auto` / `short_form_only` / `long_form_allowed` / `long_form_preferred`); defaults to `auto` when omitted. Server is the final authority on routing — `class_hint` is advisory + policy-shaping, NOT a backend selector.
     *
     * @return self
     */
    public function setProcessing($processing)
    {
        if (is_null($processing)) {
            throw new \InvalidArgumentException('non-nullable processing cannot be null');
        }
        $this->container['processing'] = $processing;

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


