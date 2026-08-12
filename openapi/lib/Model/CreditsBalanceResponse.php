<?php
/**
 * CreditsBalanceResponse
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
 * CreditsBalanceResponse Class Doc Comment
 *
 * @category Class
 * @description Snapshot of the caller&#39;s credit position at request time. Per ticket [I23 &#x60;DffjC3zm&#x60;](https://trello.com/c/DffjC3zm) + plan v5 §F9 round-13 narrowing — this is the canonical user-visible billing surface (&#x60;/api/v2/credits/estimate&#x60; and &#x60;/api/billing/summary&#x60; are NOT shipped).  All integer fields are non-negative whole credits except &#x60;available_credits&#x60; which is server-computed and not constrained to non-negative (an overdraft-exhausted caller with active reservation may transiently report negative; SDKs should clamp at zero for display).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreditsBalanceResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CreditsBalanceResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'monthly_balance' => 'int',
        'purchased_balance' => 'int',
        'overdraft_limit' => 'int',
        'overdraft_debt' => 'int',
        'available_credits' => 'int',
        'monthly_allowance' => 'int',
        'tier' => '\Gisl\Generated\OpenApi\Model\UserTier'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'monthly_balance' => null,
        'purchased_balance' => null,
        'overdraft_limit' => null,
        'overdraft_debt' => null,
        'available_credits' => null,
        'monthly_allowance' => null,
        'tier' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'monthly_balance' => false,
        'purchased_balance' => false,
        'overdraft_limit' => false,
        'overdraft_debt' => false,
        'available_credits' => false,
        'monthly_allowance' => false,
        'tier' => false
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
        'monthly_balance' => 'monthly_balance',
        'purchased_balance' => 'purchased_balance',
        'overdraft_limit' => 'overdraft_limit',
        'overdraft_debt' => 'overdraft_debt',
        'available_credits' => 'available_credits',
        'monthly_allowance' => 'monthly_allowance',
        'tier' => 'tier'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'monthly_balance' => 'setMonthlyBalance',
        'purchased_balance' => 'setPurchasedBalance',
        'overdraft_limit' => 'setOverdraftLimit',
        'overdraft_debt' => 'setOverdraftDebt',
        'available_credits' => 'setAvailableCredits',
        'monthly_allowance' => 'setMonthlyAllowance',
        'tier' => 'setTier'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'monthly_balance' => 'getMonthlyBalance',
        'purchased_balance' => 'getPurchasedBalance',
        'overdraft_limit' => 'getOverdraftLimit',
        'overdraft_debt' => 'getOverdraftDebt',
        'available_credits' => 'getAvailableCredits',
        'monthly_allowance' => 'getMonthlyAllowance',
        'tier' => 'getTier'
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
        $this->setIfExists('monthly_balance', $data ?? [], null);
        $this->setIfExists('purchased_balance', $data ?? [], null);
        $this->setIfExists('overdraft_limit', $data ?? [], null);
        $this->setIfExists('overdraft_debt', $data ?? [], null);
        $this->setIfExists('available_credits', $data ?? [], null);
        $this->setIfExists('monthly_allowance', $data ?? [], null);
        $this->setIfExists('tier', $data ?? [], null);
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

        if ($this->container['monthly_balance'] === null) {
            $invalidProperties[] = "'monthly_balance' can't be null";
        }
        if (($this->container['monthly_balance'] < 0)) {
            $invalidProperties[] = "invalid value for 'monthly_balance', must be bigger than or equal to 0.";
        }

        if ($this->container['purchased_balance'] === null) {
            $invalidProperties[] = "'purchased_balance' can't be null";
        }
        if (($this->container['purchased_balance'] < 0)) {
            $invalidProperties[] = "invalid value for 'purchased_balance', must be bigger than or equal to 0.";
        }

        if ($this->container['overdraft_limit'] === null) {
            $invalidProperties[] = "'overdraft_limit' can't be null";
        }
        if (($this->container['overdraft_limit'] < 0)) {
            $invalidProperties[] = "invalid value for 'overdraft_limit', must be bigger than or equal to 0.";
        }

        if ($this->container['overdraft_debt'] === null) {
            $invalidProperties[] = "'overdraft_debt' can't be null";
        }
        if (($this->container['overdraft_debt'] < 0)) {
            $invalidProperties[] = "invalid value for 'overdraft_debt', must be bigger than or equal to 0.";
        }

        if ($this->container['available_credits'] === null) {
            $invalidProperties[] = "'available_credits' can't be null";
        }
        if ($this->container['monthly_allowance'] === null) {
            $invalidProperties[] = "'monthly_allowance' can't be null";
        }
        if (($this->container['monthly_allowance'] < 0)) {
            $invalidProperties[] = "invalid value for 'monthly_allowance', must be bigger than or equal to 0.";
        }

        if ($this->container['tier'] === null) {
            $invalidProperties[] = "'tier' can't be null";
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
     * Gets monthly_balance
     *
     * @return int
     */
    public function getMonthlyBalance()
    {
        return $this->container['monthly_balance'];
    }

    /**
     * Sets monthly_balance
     *
     * @param int $monthly_balance Remaining credits in the monthly tier-allowance pool.
     *
     * @return self
     */
    public function setMonthlyBalance($monthly_balance)
    {
        if (is_null($monthly_balance)) {
            throw new \InvalidArgumentException('non-nullable monthly_balance cannot be null');
        }

        if (($monthly_balance < 0)) {
            throw new \InvalidArgumentException('invalid value for $monthly_balance when calling CreditsBalanceResponse., must be bigger than or equal to 0.');
        }

        $this->container['monthly_balance'] = $monthly_balance;

        return $this;
    }

    /**
     * Gets purchased_balance
     *
     * @return int
     */
    public function getPurchasedBalance()
    {
        return $this->container['purchased_balance'];
    }

    /**
     * Sets purchased_balance
     *
     * @param int $purchased_balance Remaining credits from one-off top-ups (no expiry).
     *
     * @return self
     */
    public function setPurchasedBalance($purchased_balance)
    {
        if (is_null($purchased_balance)) {
            throw new \InvalidArgumentException('non-nullable purchased_balance cannot be null');
        }

        if (($purchased_balance < 0)) {
            throw new \InvalidArgumentException('invalid value for $purchased_balance when calling CreditsBalanceResponse., must be bigger than or equal to 0.');
        }

        $this->container['purchased_balance'] = $purchased_balance;

        return $this;
    }

    /**
     * Gets overdraft_limit
     *
     * @return int
     */
    public function getOverdraftLimit()
    {
        return $this->container['overdraft_limit'];
    }

    /**
     * Sets overdraft_limit
     *
     * @param int $overdraft_limit Maximum credits this caller can go negative against.
     *
     * @return self
     */
    public function setOverdraftLimit($overdraft_limit)
    {
        if (is_null($overdraft_limit)) {
            throw new \InvalidArgumentException('non-nullable overdraft_limit cannot be null');
        }

        if (($overdraft_limit < 0)) {
            throw new \InvalidArgumentException('invalid value for $overdraft_limit when calling CreditsBalanceResponse., must be bigger than or equal to 0.');
        }

        $this->container['overdraft_limit'] = $overdraft_limit;

        return $this;
    }

    /**
     * Gets overdraft_debt
     *
     * @return int
     */
    public function getOverdraftDebt()
    {
        return $this->container['overdraft_debt'];
    }

    /**
     * Sets overdraft_debt
     *
     * @param int $overdraft_debt Credits currently owed against the overdraft pool.
     *
     * @return self
     */
    public function setOverdraftDebt($overdraft_debt)
    {
        if (is_null($overdraft_debt)) {
            throw new \InvalidArgumentException('non-nullable overdraft_debt cannot be null');
        }

        if (($overdraft_debt < 0)) {
            throw new \InvalidArgumentException('invalid value for $overdraft_debt when calling CreditsBalanceResponse., must be bigger than or equal to 0.');
        }

        $this->container['overdraft_debt'] = $overdraft_debt;

        return $this;
    }

    /**
     * Gets available_credits
     *
     * @return int
     */
    public function getAvailableCredits()
    {
        return $this->container['available_credits'];
    }

    /**
     * Sets available_credits
     *
     * @param int $available_credits Convenience field — what the caller can spend right now (`monthly_balance + purchased_balance + (overdraft_limit - overdraft_debt)`). Server-computed; SDKs MAY recompute from the bucket fields if they prefer.
     *
     * @return self
     */
    public function setAvailableCredits($available_credits)
    {
        if (is_null($available_credits)) {
            throw new \InvalidArgumentException('non-nullable available_credits cannot be null');
        }
        $this->container['available_credits'] = $available_credits;

        return $this;
    }

    /**
     * Gets monthly_allowance
     *
     * @return int
     */
    public function getMonthlyAllowance()
    {
        return $this->container['monthly_allowance'];
    }

    /**
     * Sets monthly_allowance
     *
     * @param int $monthly_allowance Tier base allowance per cycle (informational).
     *
     * @return self
     */
    public function setMonthlyAllowance($monthly_allowance)
    {
        if (is_null($monthly_allowance)) {
            throw new \InvalidArgumentException('non-nullable monthly_allowance cannot be null');
        }

        if (($monthly_allowance < 0)) {
            throw new \InvalidArgumentException('invalid value for $monthly_allowance when calling CreditsBalanceResponse., must be bigger than or equal to 0.');
        }

        $this->container['monthly_allowance'] = $monthly_allowance;

        return $this;
    }

    /**
     * Gets tier
     *
     * @return \Gisl\Generated\OpenApi\Model\UserTier
     */
    public function getTier()
    {
        return $this->container['tier'];
    }

    /**
     * Sets tier
     *
     * @param \Gisl\Generated\OpenApi\Model\UserTier $tier tier
     *
     * @return self
     */
    public function setTier($tier)
    {
        if (is_null($tier)) {
            throw new \InvalidArgumentException('non-nullable tier cannot be null');
        }
        $this->container['tier'] = $tier;

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


