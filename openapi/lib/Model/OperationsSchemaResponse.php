<?php
/**
 * OperationsSchemaResponse
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
 * The version of the OpenAPI document: 2.166.0
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
 * OperationsSchemaResponse Class Doc Comment
 *
 * @category Class
 * @description Operations meta-schema. Describes all available operation types, their options, constraints, defaults, MIME type applicability, and **availability metadata** (operation/mime_group/option-level via &#x60;availability:&#x60; per ADR-0001 §1.3 + ticket I1; per-enum-value via &#x60;per_value_availability:&#x60; per ADR-0001 §1.4 + ticket I17).  Each operation defines options with types, constraints, and conditional dependencies (via &#x60;depends_on&#x60;). Clients use this to build dynamic forms and validate options before submission.  **Tier-scoped per caller.** The response varies by the caller&#39;s subscription tier (&#x60;free&#x60; / &#x60;pro&#x60; / &#x60;enterprise&#x60;) — features gated by &#x60;required_tier&#x60; are rendered as &#x60;availability: planned&#x60; (or the appropriate tier-restriction state) for callers below the gating tier. Anonymous (unauthenticated) callers receive the &#x60;free&#x60; tier baseline (&#x60;user_tier: null&#x60; on the wire).  **Caching.** Per-tier private caching with ETag-based revalidation (per ADR-0002). Public CDN caching is NOT used because the cache key includes the caller&#39;s &#x60;user_tier&#x60;. Clients send &#x60;If-None-Match&#x60; to revalidate; the server returns &#x60;304 Not Modified&#x60; when fresh. The content &#x60;ETag&#x60; is the sole conditional validator — &#x60;If-Modified-Since&#x60; is not honored and &#x60;Last-Modified&#x60; is informational only (per &#x60;sUyA9ZXD&#x60;).  Cache-key composition: &#x60;user_tier + schema_version + capabilities_version + environment&#x60;.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OperationsSchemaResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OperationsSchemaResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'schema_version' => 'string',
        'capabilities_version' => 'int',
        'generated_at' => '\DateTime',
        'source_commit' => 'string',
        'environment' => 'string',
        'user_tier' => '\Gisl\Generated\OpenApi\Model\UserTier',
        'operations' => 'array<string,\Gisl\Generated\OpenApi\Model\OperationSchemaDefinition>',
        'endpoints' => 'array<string,\Gisl\Generated\OpenApi\Model\EndpointProjection>',
        'workflow_features' => '\Gisl\Generated\OpenApi\Model\OperationsSchemaResponseWorkflowFeatures',
        'image_encode_capabilities' => '\Gisl\Generated\OpenApi\Model\ImageEncodeCapabilities',
        'capabilities' => 'array<string,\Gisl\Generated\OpenApi\Model\OperationCapability>',
        'output_properties' => 'array<string,\Gisl\Generated\OpenApi\Model\OutputProperties>'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'schema_version' => null,
        'capabilities_version' => null,
        'generated_at' => 'date-time',
        'source_commit' => null,
        'environment' => null,
        'user_tier' => null,
        'operations' => null,
        'endpoints' => null,
        'workflow_features' => null,
        'image_encode_capabilities' => null,
        'capabilities' => null,
        'output_properties' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'schema_version' => false,
        'capabilities_version' => false,
        'generated_at' => true,
        'source_commit' => true,
        'environment' => true,
        'user_tier' => true,
        'operations' => false,
        'endpoints' => false,
        'workflow_features' => false,
        'image_encode_capabilities' => false,
        'capabilities' => false,
        'output_properties' => false
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
        'schema_version' => 'schema_version',
        'capabilities_version' => 'capabilities_version',
        'generated_at' => 'generated_at',
        'source_commit' => 'source_commit',
        'environment' => 'environment',
        'user_tier' => 'user_tier',
        'operations' => 'operations',
        'endpoints' => 'endpoints',
        'workflow_features' => 'workflow_features',
        'image_encode_capabilities' => 'image_encode_capabilities',
        'capabilities' => 'capabilities',
        'output_properties' => 'output_properties'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'schema_version' => 'setSchemaVersion',
        'capabilities_version' => 'setCapabilitiesVersion',
        'generated_at' => 'setGeneratedAt',
        'source_commit' => 'setSourceCommit',
        'environment' => 'setEnvironment',
        'user_tier' => 'setUserTier',
        'operations' => 'setOperations',
        'endpoints' => 'setEndpoints',
        'workflow_features' => 'setWorkflowFeatures',
        'image_encode_capabilities' => 'setImageEncodeCapabilities',
        'capabilities' => 'setCapabilities',
        'output_properties' => 'setOutputProperties'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'schema_version' => 'getSchemaVersion',
        'capabilities_version' => 'getCapabilitiesVersion',
        'generated_at' => 'getGeneratedAt',
        'source_commit' => 'getSourceCommit',
        'environment' => 'getEnvironment',
        'user_tier' => 'getUserTier',
        'operations' => 'getOperations',
        'endpoints' => 'getEndpoints',
        'workflow_features' => 'getWorkflowFeatures',
        'image_encode_capabilities' => 'getImageEncodeCapabilities',
        'capabilities' => 'getCapabilities',
        'output_properties' => 'getOutputProperties'
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
        $this->setIfExists('schema_version', $data ?? [], null);
        $this->setIfExists('capabilities_version', $data ?? [], null);
        $this->setIfExists('generated_at', $data ?? [], null);
        $this->setIfExists('source_commit', $data ?? [], null);
        $this->setIfExists('environment', $data ?? [], null);
        $this->setIfExists('user_tier', $data ?? [], null);
        $this->setIfExists('operations', $data ?? [], null);
        $this->setIfExists('endpoints', $data ?? [], null);
        $this->setIfExists('workflow_features', $data ?? [], null);
        $this->setIfExists('image_encode_capabilities', $data ?? [], null);
        $this->setIfExists('capabilities', $data ?? [], null);
        $this->setIfExists('output_properties', $data ?? [], null);
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

        if ($this->container['schema_version'] === null) {
            $invalidProperties[] = "'schema_version' can't be null";
        }
        if ($this->container['capabilities_version'] === null) {
            $invalidProperties[] = "'capabilities_version' can't be null";
        }
        if ($this->container['generated_at'] === null && !$this->isNullableSetToNull('generated_at')) {
            $invalidProperties[] = "'generated_at' can't be null";
        }
        if (!is_null($this->container['source_commit']) && !preg_match("/^[0-9a-f]{7,40}$/", $this->container['source_commit'])) {
            $invalidProperties[] = "invalid value for 'source_commit', must be conform to the pattern /^[0-9a-f]{7,40}$/.";
        }

        if ($this->container['operations'] === null) {
            $invalidProperties[] = "'operations' can't be null";
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
     * Gets schema_version
     *
     * @return string
     */
    public function getSchemaVersion()
    {
        return $this->container['schema_version'];
    }

    /**
     * Sets schema_version
     *
     * @param string $schema_version Schema-format version (semver). Bumps on YAML schema-format changes (e.g. new `OptionSchema` fields, structural changes). Used as part of the cache key. Pinned to the OpenAPI `info.version` value to keep runtime + static sidecar (`availability.json`, ticket I3b) consistent.
     *
     * @return self
     */
    public function setSchemaVersion($schema_version)
    {
        if (is_null($schema_version)) {
            throw new \InvalidArgumentException('non-nullable schema_version cannot be null');
        }
        $this->container['schema_version'] = $schema_version;

        return $this;
    }

    /**
     * Gets capabilities_version
     *
     * @return int
     */
    public function getCapabilitiesVersion()
    {
        return $this->container['capabilities_version'];
    }

    /**
     * Sets capabilities_version
     *
     * @param int $capabilities_version Monotonically-increasing capability matrix version. Bumps independently of `schema_version` whenever the underlying availability matrix changes (Lambda capability flips, tier policy updates, V2-planned op promotions). Used as part of the cache key. Per ADR-0002.
     *
     * @return self
     */
    public function setCapabilitiesVersion($capabilities_version)
    {
        if (is_null($capabilities_version)) {
            throw new \InvalidArgumentException('non-nullable capabilities_version cannot be null');
        }
        $this->container['capabilities_version'] = $capabilities_version;

        return $this;
    }

    /**
     * Gets generated_at
     *
     * @return \DateTime|null
     */
    public function getGeneratedAt()
    {
        return $this->container['generated_at'];
    }

    /**
     * Sets generated_at
     *
     * @param \DateTime|null $generated_at generated_at
     *
     * @return self
     */
    public function setGeneratedAt($generated_at)
    {
        if (is_null($generated_at)) {
            array_push($this->openAPINullablesSetToNull, 'generated_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('generated_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['generated_at'] = $generated_at;

        return $this;
    }

    /**
     * Gets source_commit
     *
     * @return string|null
     */
    public function getSourceCommit()
    {
        return $this->container['source_commit'];
    }

    /**
     * Sets source_commit
     *
     * @param string|null $source_commit source_commit
     *
     * @return self
     */
    public function setSourceCommit($source_commit)
    {
        if (is_null($source_commit)) {
            array_push($this->openAPINullablesSetToNull, 'source_commit');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('source_commit', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($source_commit) && (!preg_match("/^[0-9a-f]{7,40}$/", ObjectSerializer::toString($source_commit)))) {
            throw new \InvalidArgumentException("invalid value for \$source_commit when calling OperationsSchemaResponse., must conform to the pattern /^[0-9a-f]{7,40}$/.");
        }

        $this->container['source_commit'] = $source_commit;

        return $this;
    }

    /**
     * Gets environment
     *
     * @return string|null
     */
    public function getEnvironment()
    {
        return $this->container['environment'];
    }

    /**
     * Sets environment
     *
     * @param string|null $environment environment
     *
     * @return self
     */
    public function setEnvironment($environment)
    {
        if (is_null($environment)) {
            array_push($this->openAPINullablesSetToNull, 'environment');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('environment', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['environment'] = $environment;

        return $this;
    }

    /**
     * Gets user_tier
     *
     * @return \Gisl\Generated\OpenApi\Model\UserTier|null
     */
    public function getUserTier()
    {
        return $this->container['user_tier'];
    }

    /**
     * Sets user_tier
     *
     * @param \Gisl\Generated\OpenApi\Model\UserTier|null $user_tier user_tier
     *
     * @return self
     */
    public function setUserTier($user_tier)
    {
        if (is_null($user_tier)) {
            array_push($this->openAPINullablesSetToNull, 'user_tier');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('user_tier', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['user_tier'] = $user_tier;

        return $this;
    }

    /**
     * Gets operations
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\OperationSchemaDefinition>
     */
    public function getOperations()
    {
        return $this->container['operations'];
    }

    /**
     * Sets operations
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\OperationSchemaDefinition> $operations Map of operation type to its schema definition (with availability metadata per I1 / I17).
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
     * Gets endpoints
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\EndpointProjection>|null
     */
    public function getEndpoints()
    {
        return $this->container['endpoints'];
    }

    /**
     * Sets endpoints
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\EndpointProjection>|null $endpoints Flat per-endpoint auth/identity projection per [ADR-0016](../docs/decisions/0016-per-endpoint-auth-identity-modeling.md) §D4. Keys are `<METHOD> <PATH>` literals (e.g. `\"POST /api/workflows\"`); values declare the auth axis + identity-scoping + reserved tier/availability slots + operation_id for SDK ergonomic-layer consumption.  Webhook operations are EXCLUDED per ADR-0016 §D5 — outbound HMAC-signed callbacks use a separate auth model.  **Optional in the wire envelope** to keep the runtime endpoint's mirroring obligation incremental: the committed sidecar (yN309QVb-B3 / v2.17.0+) emits this block authoritatively; the runtime `GET /api/operations/ schema` MAY mirror it once the API team's runtime generator catches up. Consumers MUST tolerate absent `endpoints` from the runtime endpoint (read the sidecar instead) and MUST tolerate present `endpoints` from either source.
     *
     * @return self
     */
    public function setEndpoints($endpoints)
    {
        if (is_null($endpoints)) {
            throw new \InvalidArgumentException('non-nullable endpoints cannot be null');
        }
        $this->container['endpoints'] = $endpoints;

        return $this;
    }

    /**
     * Gets workflow_features
     *
     * @return \Gisl\Generated\OpenApi\Model\OperationsSchemaResponseWorkflowFeatures|null
     */
    public function getWorkflowFeatures()
    {
        return $this->container['workflow_features'];
    }

    /**
     * Sets workflow_features
     *
     * @param \Gisl\Generated\OpenApi\Model\OperationsSchemaResponseWorkflowFeatures|null $workflow_features workflow_features
     *
     * @return self
     */
    public function setWorkflowFeatures($workflow_features)
    {
        if (is_null($workflow_features)) {
            throw new \InvalidArgumentException('non-nullable workflow_features cannot be null');
        }
        $this->container['workflow_features'] = $workflow_features;

        return $this;
    }

    /**
     * Gets image_encode_capabilities
     *
     * @return \Gisl\Generated\OpenApi\Model\ImageEncodeCapabilities|null
     */
    public function getImageEncodeCapabilities()
    {
        return $this->container['image_encode_capabilities'];
    }

    /**
     * Sets image_encode_capabilities
     *
     * @param \Gisl\Generated\OpenApi\Model\ImageEncodeCapabilities|null $image_encode_capabilities Pre-flight image-encode capability matrix (`webp_quality_supported`, `background_flatten`, …) — **IDENTICAL shape to `composition_plan.capabilities`** on the create-workflow 201, surfaced here so SDK/FE can fail-fast guard format/quality/alpha-flatten choices BEFORE submitting a workflow. Reuses the same API-side producer so the two can never disagree.  **Tier-invariant.** This is a fixed codec/hardware capability fact (what the image encoders CAN do), NOT an entitlement — identical for every tier including anonymous. Deliberately carries no `availability` tag, no `per_value_availability`, and does NOT vary by `user_tier` (even though the enclosing response is tier-scoped).  **Optional in the wire envelope** (same incremental-mirroring stance as `endpoints` / `workflow_features`): the committed sidecar MAY emit it; the runtime `GET /api/operations/schema` emits it once the API generator catches up. Consumers MUST tolerate its absence and its presence from either source. Per ticket [`kybXQe2S`](https://trello.com/c/kybXQe2S).
     *
     * @return self
     */
    public function setImageEncodeCapabilities($image_encode_capabilities)
    {
        if (is_null($image_encode_capabilities)) {
            throw new \InvalidArgumentException('non-nullable image_encode_capabilities cannot be null');
        }
        $this->container['image_encode_capabilities'] = $image_encode_capabilities;

        return $this;
    }

    /**
     * Gets capabilities
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\OperationCapability>|null
     */
    public function getCapabilities()
    {
        return $this->container['capabilities'];
    }

    /**
     * Sets capabilities
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\OperationCapability>|null $capabilities Tier-scoped operation-capability matrix (the [operation-capability constraint model](../operation-capabilities/operation-capabilities.json), ADR-0024) — per operation type: `accepts` (media classes), `input` (cardinality), `produces`, `availability`, `sole_op`, and the three constraint families (`excludes` / `requires` / `option_conflicts`). Consumers use it to pre-validate operation composition (compatibility, ordering, output propagation) without hardcoding pairwise rules.  Each `OperationCapability` is left OPEN (no `additionalProperties: false`) so future capability families ride through untyped — consumers MUST tolerate extra keys.  **Optional in the wire envelope** (same incremental-mirroring stance as `endpoints` / `workflow_features` / `image_encode_capabilities`): the runtime `GET /api/operations/schema` emits it (API ticket `uneE8Yoz`); the committed sidecar MAY mirror it once the generator catches up. Consumers MUST tolerate its absence and its presence from either source. Per ticket [`9E3oqGNK`](https://trello.com/c/9E3oqGNK).
     *
     * @return self
     */
    public function setCapabilities($capabilities)
    {
        if (is_null($capabilities)) {
            throw new \InvalidArgumentException('non-nullable capabilities cannot be null');
        }
        $this->container['capabilities'] = $capabilities;

        return $this;
    }

    /**
     * Gets output_properties
     *
     * @return array<string,\Gisl\Generated\OpenApi\Model\OutputProperties>|null
     */
    public function getOutputProperties()
    {
        return $this->container['output_properties'];
    }

    /**
     * Sets output_properties
     *
     * @param array<string,\Gisl\Generated\OpenApi\Model\OutputProperties>|null $output_properties Output-format property table (`output_format` → media facts) backing the capability model's forward output-propagation: `hasAudioTrack` (does this format carry an audio stream) and `isAnimated` (single-frame vs animated; `\"maybe\"` for formats that can be either, e.g. GIF/WebP). Consumers use it to reason about what a chained operation's output can feed downstream.  **Tier-invariant** — a fixed codec fact, not an entitlement (carries no `availability`).  **Optional in the wire envelope** (same incremental-mirroring stance as the sibling blocks above). Per ticket [`9E3oqGNK`](https://trello.com/c/9E3oqGNK).
     *
     * @return self
     */
    public function setOutputProperties($output_properties)
    {
        if (is_null($output_properties)) {
            throw new \InvalidArgumentException('non-nullable output_properties cannot be null');
        }
        $this->container['output_properties'] = $output_properties;

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


