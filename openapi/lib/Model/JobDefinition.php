<?php
/**
 * JobDefinition
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
 * The version of the OpenAPI document: 2.193.0
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
 * JobDefinition Class Doc Comment
 *
 * @category Class
 * @description V2 job within a workflow. Per [ADR-0004](../docs/decisions/0004-job-shape.md).  **Source shape (mutually exclusive):** - &#x60;source&#x60; (single-input): a &#x60;WorkflowSource&#x60; value (4-leaf   discriminated union: &#x60;upload&#x60; / &#x60;external_import&#x60; / &#x60;connection&#x60; /   &#x60;job_output&#x60;). Used by single-input operations (compress, thumbnail,   text_watermark, convert). - &#x60;inputs[]&#x60; (multi-input): array of &#x60;JobInputV2&#x60; entries. Each entry   carries its own &#x60;source&#x60; plus an optional &#x60;role&#x60;   (image_watermark, custom_luma, audio_overlay, audio_to_video,   video_watermark) and   &#x60;per_input_options&#x60;. Used by multi-input operations (merge,   archive, image_watermark, custom_luma, audio_overlay,   audio_to_video, video_watermark).  Exactly one of &#x60;source&#x60; or &#x60;inputs&#x60; is required.  **&#x60;id&#x60; is optional.** When omitted, the server auto-generates &#x60;job_N&#x60; (positional, 0-indexed). Required only when this job is referenced by: - Another job&#39;s &#x60;source.from&#x60; (&#x60;JobOutputSource.from&#x60;) or   &#x60;inputs[].source.from&#x60; - &#x60;workflow_edges[].from&#x60; / &#x60;.to&#x60; - &#x60;delivery.selection.explicit.refs[].ref&#x60; (delivery_plan, ticket I8-CONS)  User-supplied IDs matching the reserved pattern &#x60;^job_\\d+$&#x60; are rejected — this avoids collisions with the auto-generated naming scheme.  **Server computes &#x60;depends_on&#x60;** from &#x60;JobOutputSource.from&#x60; references at job-level and inputs[]-level. &#x60;workflow_edges&#x60; is rarely needed and is preserved as an optional override for non-typical DAG topologies (e.g. side-effect dependencies that don&#39;t surface as &#x60;from&#x60; references).  **Role validation per operation type** (runtime enforcement; contract documents the rule): - &#x60;image_watermark&#x60;: exactly one input with &#x60;role: base&#x60; AND one   with &#x60;role: overlay&#x60; (per [I4-CONS](https://trello.com/c/2dZiW1BF)). - &#x60;custom_luma&#x60;: exactly one input with &#x60;role: base&#x60; AND one   with &#x60;role: transition_mask&#x60; (per   [I29](https://trello.com/c/EPUE5Vs1)). - &#x60;audio_overlay&#x60;: exactly one input with &#x60;role: base&#x60; AND one   with &#x60;role: overlay&#x60; (per   [I19](https://trello.com/c/Xr3Z4GBF)). The &#x60;overlay&#x60; role   label is shared with &#x60;image_watermark&#x60; — semantics differ   by operation type. - &#x60;text_watermark&#x60;: single-input via &#x60;source&#x60; (not &#x60;inputs[]&#x60;); no   &#x60;role&#x60; field. - &#x60;merge&#x60; / &#x60;archive&#x60;: no &#x60;role&#x60; field on inputs (all inputs   share the same role).  **Greenfield V2.0 cutover.** V1 &#x60;JobDefinition&#x60; (with required &#x60;ref&#x60; field and three-way &#x60;file_id&#x60;/&#x60;source&#x60;/&#x60;inputs&#x60; mutex) is replaced wholesale per ADR-0004 §\&quot;Greenfield V2.0 cutover\&quot;. V1 &#x60;JobSource&#x60; and &#x60;JobInput&#x60; schemas are deleted; their job-output and per-input semantics live in &#x60;JobOutputSource&#x60; and &#x60;JobInputV2&#x60; respectively.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class JobDefinition implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'JobDefinition';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id' => 'string',
        'source' => '\Gisl\Generated\OpenApi\Model\WorkflowSource',
        'inputs' => '\Gisl\Generated\OpenApi\Model\JobInputV2[]',
        'operations' => '\Gisl\Generated\OpenApi\Model\OperationDefinition[]',
        'deliver' => 'bool'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id' => null,
        'source' => null,
        'inputs' => null,
        'operations' => null,
        'deliver' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id' => false,
        'source' => false,
        'inputs' => false,
        'operations' => false,
        'deliver' => false
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
        'id' => 'id',
        'source' => 'source',
        'inputs' => 'inputs',
        'operations' => 'operations',
        'deliver' => 'deliver'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'source' => 'setSource',
        'inputs' => 'setInputs',
        'operations' => 'setOperations',
        'deliver' => 'setDeliver'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'source' => 'getSource',
        'inputs' => 'getInputs',
        'operations' => 'getOperations',
        'deliver' => 'getDeliver'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('source', $data ?? [], null);
        $this->setIfExists('inputs', $data ?? [], null);
        $this->setIfExists('operations', $data ?? [], null);
        $this->setIfExists('deliver', $data ?? [], false);
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

        if (!is_null($this->container['id']) && !preg_match("/^(?!job_\\d+$)[A-Za-z][A-Za-z0-9_-]*$/", $this->container['id'])) {
            $invalidProperties[] = "invalid value for 'id', must be conform to the pattern /^(?!job_\\d+$)[A-Za-z][A-Za-z0-9_-]*$/.";
        }

        if (!is_null($this->container['inputs']) && (count($this->container['inputs']) < 1)) {
            $invalidProperties[] = "invalid value for 'inputs', number of items must be greater than or equal to 1.";
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
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id Optional local identifier within the workflow. Auto-generated `job_N` when omitted. Required when referenced by other jobs, workflow_edges, or delivery_plan. Reserved pattern `^job_\\d+$` — user-supplied IDs matching this pattern are rejected at the JSON-Schema layer via the negative lookahead in the `pattern` below.
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }

        if ((!preg_match("/^(?!job_\\d+$)[A-Za-z][A-Za-z0-9_-]*$/", ObjectSerializer::toString($id)))) {
            throw new \InvalidArgumentException("invalid value for \$id when calling JobDefinition., must conform to the pattern /^(?!job_\\d+$)[A-Za-z][A-Za-z0-9_-]*$/.");
        }

        $this->container['id'] = $id;

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
     * @param \Gisl\Generated\OpenApi\Model\WorkflowSource|null $source source
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
     * Gets inputs
     *
     * @return \Gisl\Generated\OpenApi\Model\JobInputV2[]|null
     */
    public function getInputs()
    {
        return $this->container['inputs'];
    }

    /**
     * Sets inputs
     *
     * @param \Gisl\Generated\OpenApi\Model\JobInputV2[]|null $inputs Multi-input list for `merge`, `archive`, `image_watermark`, `custom_luma`, `audio_overlay`, `audio_to_video`, and `video_watermark`. Each entry is a `JobInputV2` with its own `MultiInputSource` (the 3-leaf subset of `WorkflowSource` that excludes upload-direct; uploads enter via a `passthrough` source job referenced by `job_output`). Mutually exclusive with `source` — the V2 shape boundary stays `source` (single-input) XOR `inputs[]` (multi-input role-based) per ADR-0004 / I12.  **Minimum input count = sum of role minima** declared in the operation's `per_role_cardinality` (per ticket [`SlluxMBN`](https://trello.com/c/SlluxMBN) ADR-0015). `audio_to_video` requires 1 input (`base` audio; `overlay` optional, 0..1); all other role-based ops require 2+ today. The schema floor here is `minItems: 1` to admit the audio_to_video case; per-operation gates enforce the actual count via `OperationSchemaDefinition.min_inputs`.
     *
     * @return self
     */
    public function setInputs($inputs)
    {
        if (is_null($inputs)) {
            throw new \InvalidArgumentException('non-nullable inputs cannot be null');
        }


        if ((count($inputs) < 1)) {
            throw new \InvalidArgumentException('invalid length for $inputs when calling JobDefinition., number of items must be greater than or equal to 1.');
        }
        $this->container['inputs'] = $inputs;

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
     * @param \Gisl\Generated\OpenApi\Model\OperationDefinition[]|null $operations Unordered **set** of operations for this job. The API canonicalizes them to a deterministic order — submitted order does not affect the result (same set, any order → same plan → same bytes). The resolved canonical order is echoed in the response `composition_plan` (see `WorkflowCreateResponse.composition_plan`). Each canonical chain operation consumes the previous operation's output; all intermediate and final outputs are kept.  Order-independence is over a *well-formed* set: conflicting or duplicate same-stage operations (e.g. two `compress` with different options) are resolved or rejected by the canonicalization engine — the contract does not enumerate the conflict-resolution rules (engine-side, like the opaque processing-time estimator). A rejected set surfaces as a `validation_error` (422); it is not silently ordered.  Multi-input jobs (with `inputs[]`) must have exactly one operation, and it must be a multi-input type (`merge`, `archive`, `image_watermark`, `custom_luma`, `audio_overlay`, `audio_to_video`, or `video_watermark`).
     *
     * @return self
     */
    public function setOperations($operations)
    {
        if (is_null($operations)) {
            throw new \InvalidArgumentException('non-nullable operations cannot be null');
        }
        $this->container['operations'] = $operations;

        return $this;
    }

    /**
     * Gets deliver
     *
     * @return bool|null
     */
    public function getDeliver()
    {
        return $this->container['deliver'];
    }

    /**
     * Sets deliver
     *
     * @param bool|null $deliver Per-job hide-intermediates promotion flag per [ADR-0003](../docs/decisions/0003-delivery-mode.md) §\"Per-job deliver flag\". When `true`, this job's output is promoted into the deliverable set even if it's an intermediate (not a leaf terminal).  Mutually exclusive with `delivery.selection.type: explicit` at the workflow level — the validator rejects a workflow that combines explicit selection with any per-job `deliver: true`.
     *
     * @return self
     */
    public function setDeliver($deliver)
    {
        if (is_null($deliver)) {
            throw new \InvalidArgumentException('non-nullable deliver cannot be null');
        }
        $this->container['deliver'] = $deliver;

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


