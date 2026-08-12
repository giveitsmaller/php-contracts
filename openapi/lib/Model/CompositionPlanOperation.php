<?php
/**
 * CompositionPlanOperation
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
 * The version of the OpenAPI document: 2.192.0
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
 * CompositionPlanOperation Class Doc Comment
 *
 * @category Class
 * @description The canonical view of one operation within a job — its symbolic composition node, resolved chain placement, and (for derived artifacts) the node it branches from.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CompositionPlanOperation implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CompositionPlanOperation';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'node_id' => 'string',
        'operation_id' => 'string',
        'type' => '\Gisl\Generated\OpenApi\Model\OperationType',
        'chain_group' => 'string',
        'chain_position' => 'int',
        'derived_from' => 'string',
        'requested_operations' => '\Gisl\Generated\OpenApi\Model\OperationType[]'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'node_id' => null,
        'operation_id' => 'uuid',
        'type' => null,
        'chain_group' => null,
        'chain_position' => null,
        'derived_from' => null,
        'requested_operations' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'node_id' => false,
        'operation_id' => false,
        'type' => false,
        'chain_group' => false,
        'chain_position' => false,
        'derived_from' => false,
        'requested_operations' => false
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
        'node_id' => 'node_id',
        'operation_id' => 'operation_id',
        'type' => 'type',
        'chain_group' => 'chain_group',
        'chain_position' => 'chain_position',
        'derived_from' => 'derived_from',
        'requested_operations' => 'requested_operations'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'node_id' => 'setNodeId',
        'operation_id' => 'setOperationId',
        'type' => 'setType',
        'chain_group' => 'setChainGroup',
        'chain_position' => 'setChainPosition',
        'derived_from' => 'setDerivedFrom',
        'requested_operations' => 'setRequestedOperations'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'node_id' => 'getNodeId',
        'operation_id' => 'getOperationId',
        'type' => 'getType',
        'chain_group' => 'getChainGroup',
        'chain_position' => 'getChainPosition',
        'derived_from' => 'getDerivedFrom',
        'requested_operations' => 'getRequestedOperations'
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
        $this->setIfExists('node_id', $data ?? [], null);
        $this->setIfExists('operation_id', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('chain_group', $data ?? [], null);
        $this->setIfExists('chain_position', $data ?? [], null);
        $this->setIfExists('derived_from', $data ?? [], null);
        $this->setIfExists('requested_operations', $data ?? [], null);
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

        if ($this->container['node_id'] === null) {
            $invalidProperties[] = "'node_id' can't be null";
        }
        if (!is_null($this->container['operation_id']) && !preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['operation_id'])) {
            $invalidProperties[] = "invalid value for 'operation_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['chain_group'] === null) {
            $invalidProperties[] = "'chain_group' can't be null";
        }
        if ($this->container['chain_position'] === null) {
            $invalidProperties[] = "'chain_position' can't be null";
        }
        if (($this->container['chain_position'] < 0)) {
            $invalidProperties[] = "invalid value for 'chain_position', must be bigger than or equal to 0.";
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
     * Gets node_id
     *
     * @return string
     */
    public function getNodeId()
    {
        return $this->container['node_id'];
    }

    /**
     * Sets node_id
     *
     * @param string $node_id Stable **symbolic** canonical node id (e.g. `original`, `processed_base`, `encode`, `thumbnail`). The correlation key used by `derived_from`, `DeliveryPlanOutput.node_id`, and `OperationDownload.node_id` to tie delivered files back to a canonical node. **NOT** the operation UUID. (SSE stays per-operation by design — it is not a delivery-plan projection and does not carry `node_id`.)
     *
     * @return self
     */
    public function setNodeId($node_id)
    {
        if (is_null($node_id)) {
            throw new \InvalidArgumentException('non-nullable node_id cannot be null');
        }
        $this->container['node_id'] = $node_id;

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
            throw new \InvalidArgumentException('non-nullable operation_id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($operation_id)))) {
            throw new \InvalidArgumentException("invalid value for \$operation_id when calling CompositionPlanOperation., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['operation_id'] = $operation_id;

        return $this;
    }

    /**
     * Gets type
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationType
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationType $type The canonical operation type of this node. For the folded terminal `encode` node (`chain_group: encode`) this is the encode operation `compress` — `convert` folds INTO it (a single terminal encode, never a double-encode), and the folded source operations are listed in `requested_operations`. For all other nodes `type` is the operation as submitted.
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets chain_group
     *
     * @return string
     */
    public function getChainGroup()
    {
        return $this->container['chain_group'];
    }

    /**
     * Sets chain_group
     *
     * @param string $chain_group Which canonical stage this operation belongs to. **Open string, NOT a fixed enum** (mirrors `ProcessingPlanJob.execution_pool`) — the stage taxonomy is pinned alongside the canonicalization engine and tightened to an enum in the same gated cut that adds `additionalProperties: false`; consumers MUST treat unknown stage names as forward-compatible. The watermark stages are **media-agnostic overlay stages**, not image-only. Known stages: - `transform`: geometry stage (rotate/flip) — covers the   `transform` operation type. Runs first in the spine (ADR-0026);   `availability: planned` until activation. - `merge`: fan-in. - `image_watermark`: raster/image-overlay watermark stage —   covers the `image_watermark` AND `video_watermark` operation   types. - `text_watermark`: text-overlay watermark stage — covers the   `text_watermark` AND `video_text_watermark` operation types. - `audio`: audio operations (e.g. `audio_overlay`,   `audio_to_video`). - `encode`: the folded convert+compress terminal encode stage. - `derived`: fan-out artifact (`thumbnail` / `split`). Operation classes outside the image/AV spine (e.g. `archive` bundling, `passthrough` bridge jobs) carry their own stage names once the engine pins them. (The geometry/resize stage is not exposed as a node for v1 — image resize lives inside the `thumbnail` worker.)
     *
     * @return self
     */
    public function setChainGroup($chain_group)
    {
        if (is_null($chain_group)) {
            throw new \InvalidArgumentException('non-nullable chain_group cannot be null');
        }
        $this->container['chain_group'] = $chain_group;

        return $this;
    }

    /**
     * Gets chain_position
     *
     * @return int
     */
    public function getChainPosition()
    {
        return $this->container['chain_position'];
    }

    /**
     * Sets chain_position
     *
     * @param int $chain_position Deterministic resolved position within the canonical chain.
     *
     * @return self
     */
    public function setChainPosition($chain_position)
    {
        if (is_null($chain_position)) {
            throw new \InvalidArgumentException('non-nullable chain_position cannot be null');
        }

        if (($chain_position < 0)) {
            throw new \InvalidArgumentException('invalid value for $chain_position when calling CompositionPlanOperation., must be bigger than or equal to 0.');
        }

        $this->container['chain_position'] = $chain_position;

        return $this;
    }

    /**
     * Gets derived_from
     *
     * @return string|null
     */
    public function getDerivedFrom()
    {
        return $this->container['derived_from'];
    }

    /**
     * Sets derived_from
     *
     * @param string|null $derived_from Set only for derived operations (`thumbnail`, `split`): the `node_id` this artifact branches from (symbolic; resolved from the request-side `OperationDefinition.base`). Absent for chain operations.
     *
     * @return self
     */
    public function setDerivedFrom($derived_from)
    {
        if (is_null($derived_from)) {
            throw new \InvalidArgumentException('non-nullable derived_from cannot be null');
        }
        $this->container['derived_from'] = $derived_from;

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
     * @param \Gisl\Generated\OpenApi\Model\OperationType[]|null $requested_operations Image-fold audit trail: the request operation types that were absorbed into this single canonical node. For the folded `encode` node this is e.g. `[convert, compress]` — the caller still submits both, but composition exposes ONE `encode` node (no false double-encode). Absent when no fold occurred.
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


