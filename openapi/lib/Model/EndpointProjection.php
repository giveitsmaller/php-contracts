<?php
/**
 * EndpointProjection
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
 * The version of the OpenAPI document: 2.170.0
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
 * EndpointProjection Class Doc Comment
 *
 * @category Class
 * @description Per-endpoint projection entry per ADR-0016 §D4. Five fields; &#x60;required_tier&#x60; and &#x60;availability&#x60; at endpoint level are reserved/null today (operation-level &#x60;required_tier&#x60; continues to flow via &#x60;operations.*.required_tier&#x60;; every shipped endpoint is currently &#x60;availability: stable&#x60;).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class EndpointProjection implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'EndpointProjection';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'auth' => 'string',
        'identity_scoped' => 'bool',
        'required_tier' => '\Gisl\Generated\OpenApi\Model\UserTier',
        'availability' => 'string',
        'operation_id' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'auth' => null,
        'identity_scoped' => null,
        'required_tier' => null,
        'availability' => null,
        'operation_id' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'auth' => false,
        'identity_scoped' => false,
        'required_tier' => true,
        'availability' => false,
        'operation_id' => false
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
        'auth' => 'auth',
        'identity_scoped' => 'identity_scoped',
        'required_tier' => 'required_tier',
        'availability' => 'availability',
        'operation_id' => 'operation_id'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'auth' => 'setAuth',
        'identity_scoped' => 'setIdentityScoped',
        'required_tier' => 'setRequiredTier',
        'availability' => 'setAvailability',
        'operation_id' => 'setOperationId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'auth' => 'getAuth',
        'identity_scoped' => 'getIdentityScoped',
        'required_tier' => 'getRequiredTier',
        'availability' => 'getAvailability',
        'operation_id' => 'getOperationId'
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

    public const AUTH_ANONYMOUS = 'anonymous';
    public const AUTH_OPTIONAL = 'optional';
    public const AUTH_REQUIRED = 'required';
    public const AVAILABILITY_STABLE = 'stable';
    public const AVAILABILITY_BETA = 'beta';
    public const AVAILABILITY_EXPERIMENTAL = 'experimental';
    public const AVAILABILITY_PLANNED = 'planned';
    public const AVAILABILITY_DEPRECATED = 'deprecated';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAuthAllowableValues()
    {
        return [
            self::AUTH_ANONYMOUS,
            self::AUTH_OPTIONAL,
            self::AUTH_REQUIRED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAvailabilityAllowableValues()
    {
        return [
            self::AVAILABILITY_STABLE,
            self::AVAILABILITY_BETA,
            self::AVAILABILITY_EXPERIMENTAL,
            self::AVAILABILITY_PLANNED,
            self::AVAILABILITY_DEPRECATED,
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
        $this->setIfExists('auth', $data ?? [], null);
        $this->setIfExists('identity_scoped', $data ?? [], null);
        $this->setIfExists('required_tier', $data ?? [], null);
        $this->setIfExists('availability', $data ?? [], null);
        $this->setIfExists('operation_id', $data ?? [], null);
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

        if ($this->container['auth'] === null) {
            $invalidProperties[] = "'auth' can't be null";
        }
        $allowedValues = $this->getAuthAllowableValues();
        if (!is_null($this->container['auth']) && !in_array($this->container['auth'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'auth', must be one of '%s'",
                $this->container['auth'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['identity_scoped'] === null) {
            $invalidProperties[] = "'identity_scoped' can't be null";
        }
        if ($this->container['required_tier'] === null && !$this->isNullableSetToNull('required_tier')) {
            $invalidProperties[] = "'required_tier' can't be null";
        }
        if ($this->container['availability'] === null) {
            $invalidProperties[] = "'availability' can't be null";
        }
        $allowedValues = $this->getAvailabilityAllowableValues();
        if (!is_null($this->container['availability']) && !in_array($this->container['availability'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'availability', must be one of '%s'",
                $this->container['availability'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['operation_id'] === null) {
            $invalidProperties[] = "'operation_id' can't be null";
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
     * Gets auth
     *
     * @return string
     */
    public function getAuth()
    {
        return $this->container['auth'];
    }

    /**
     * Sets auth
     *
     * @param string $auth 3-value projection of the operation's `security:` block: `anonymous` (`security: []`), `optional` (`security` contains the empty requirement `{}`), `required` (otherwise).
     *
     * @return self
     */
    public function setAuth($auth)
    {
        if (is_null($auth)) {
            throw new \InvalidArgumentException('non-nullable auth cannot be null');
        }
        $allowedValues = $this->getAuthAllowableValues();
        if (!in_array($auth, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'auth', must be one of '%s'",
                    $auth,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['auth'] = $auth;

        return $this;
    }

    /**
     * Gets identity_scoped
     *
     * @return bool
     */
    public function getIdentityScoped()
    {
        return $this->container['identity_scoped'];
    }

    /**
     * Sets identity_scoped
     *
     * @param bool $identity_scoped Value of the `x-identity-scoped` vendor extension on the operation (default `false`). True iff the operation targets an identity-bound resource and cross-identity access is rejected — OR acts on the caller's implicit identity-scoped data (credits balance, own session).  The rejection code is usually `403`, but some endpoints **existence-mask cross-identity references as `404`** (BOLA/ IDOR: a 403 would leak that the resource exists). The `createWorkflow` upload reference is the canonical case — cross-owner uploads return `404 UPLOAD_NOT_FOUND`, never 403 (per the ADR-0016 amendment). Consumers MUST NOT assume `identity_scoped: true` implies a 403 specifically; read the per-operation error responses for the exact code.
     *
     * @return self
     */
    public function setIdentityScoped($identity_scoped)
    {
        if (is_null($identity_scoped)) {
            throw new \InvalidArgumentException('non-nullable identity_scoped cannot be null');
        }
        $this->container['identity_scoped'] = $identity_scoped;

        return $this;
    }

    /**
     * Gets required_tier
     *
     * @return \Gisl\Generated\OpenApi\Model\UserTier|null
     */
    public function getRequiredTier()
    {
        return $this->container['required_tier'];
    }

    /**
     * Sets required_tier
     *
     * @param \Gisl\Generated\OpenApi\Model\UserTier|null $required_tier required_tier
     *
     * @return self
     */
    public function setRequiredTier($required_tier)
    {
        if (is_null($required_tier)) {
            array_push($this->openAPINullablesSetToNull, 'required_tier');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('required_tier', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['required_tier'] = $required_tier;

        return $this;
    }

    /**
     * Gets availability
     *
     * @return string
     */
    public function getAvailability()
    {
        return $this->container['availability'];
    }

    /**
     * Sets availability
     *
     * @param string $availability Endpoint-level availability tag. Currently always `\"stable\"` for shipped endpoints. Reserved for future `planned` / `deprecated` endpoint-level annotation.
     *
     * @return self
     */
    public function setAvailability($availability)
    {
        if (is_null($availability)) {
            throw new \InvalidArgumentException('non-nullable availability cannot be null');
        }
        $allowedValues = $this->getAvailabilityAllowableValues();
        if (!in_array($availability, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'availability', must be one of '%s'",
                    $availability,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['availability'] = $availability;

        return $this;
    }

    /**
     * Gets operation_id
     *
     * @return string
     */
    public function getOperationId()
    {
        return $this->container['operation_id'];
    }

    /**
     * Sets operation_id
     *
     * @param string $operation_id OpenAPI `operationId` for the operation. SDK code generators anchor on this for method naming; including it in the sidecar saves a round-trip to `openapi/api.yaml`. Per the SDK ask at ADR-0016 B1 sign-off.
     *
     * @return self
     */
    public function setOperationId($operation_id)
    {
        if (is_null($operation_id)) {
            throw new \InvalidArgumentException('non-nullable operation_id cannot be null');
        }
        $this->container['operation_id'] = $operation_id;

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


