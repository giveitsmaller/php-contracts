<?php
/**
 * CreditTransaction
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
 * CreditTransaction Class Doc Comment
 *
 * @category Class
 * @description Single ledger entry. Immutable once written. A workflow-create reservation appears here as a single row with &#x60;source_bucket&#x60; indicating which pool(s) were debited; refunds appear as separate rows referencing the original via &#x60;reference_id&#x60; and &#x60;reference_type: workflow&#x60;.  &#x60;type&#x60;, &#x60;pricing_version&#x60;, and &#x60;reference_type&#x60; are deliberately free-form strings — their value sets evolve with billing event taxonomy and pricing-table revisions; SDKs duck-type and treat opaque (mirrors the &#x60;OperationMetrics.re_encode_reason&#x60; opacity precedent from I16-CONS).
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreditTransaction implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CreditTransaction';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id' => 'string',
        'type' => 'string',
        'amount' => 'int',
        'monthly_balance_before' => 'int',
        'monthly_balance_after' => 'int',
        'purchased_balance_before' => 'int',
        'purchased_balance_after' => 'int',
        'source_bucket' => '\Gisl\Generated\OpenApi\Model\CreditTransactionSourceBucket',
        'monthly_amount' => 'int',
        'purchased_amount' => 'int',
        'pricing_version' => 'string',
        'description' => 'string',
        'reference_type' => 'string',
        'reference_id' => 'string',
        'created_at' => '\DateTime',
        'state' => 'string',
        'state_changed_at' => '\DateTime',
        'operation_summary' => 'string',
        'operation_count' => 'int',
        'primary_filename' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id' => 'uuid',
        'type' => null,
        'amount' => null,
        'monthly_balance_before' => null,
        'monthly_balance_after' => null,
        'purchased_balance_before' => null,
        'purchased_balance_after' => null,
        'source_bucket' => null,
        'monthly_amount' => null,
        'purchased_amount' => null,
        'pricing_version' => null,
        'description' => null,
        'reference_type' => null,
        'reference_id' => null,
        'created_at' => 'date-time',
        'state' => null,
        'state_changed_at' => 'date-time',
        'operation_summary' => null,
        'operation_count' => null,
        'primary_filename' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id' => false,
        'type' => false,
        'amount' => false,
        'monthly_balance_before' => false,
        'monthly_balance_after' => false,
        'purchased_balance_before' => false,
        'purchased_balance_after' => false,
        'source_bucket' => false,
        'monthly_amount' => true,
        'purchased_amount' => true,
        'pricing_version' => false,
        'description' => false,
        'reference_type' => false,
        'reference_id' => false,
        'created_at' => false,
        'state' => true,
        'state_changed_at' => true,
        'operation_summary' => true,
        'operation_count' => true,
        'primary_filename' => true
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
        'type' => 'type',
        'amount' => 'amount',
        'monthly_balance_before' => 'monthly_balance_before',
        'monthly_balance_after' => 'monthly_balance_after',
        'purchased_balance_before' => 'purchased_balance_before',
        'purchased_balance_after' => 'purchased_balance_after',
        'source_bucket' => 'source_bucket',
        'monthly_amount' => 'monthly_amount',
        'purchased_amount' => 'purchased_amount',
        'pricing_version' => 'pricing_version',
        'description' => 'description',
        'reference_type' => 'reference_type',
        'reference_id' => 'reference_id',
        'created_at' => 'created_at',
        'state' => 'state',
        'state_changed_at' => 'state_changed_at',
        'operation_summary' => 'operation_summary',
        'operation_count' => 'operation_count',
        'primary_filename' => 'primary_filename'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'type' => 'setType',
        'amount' => 'setAmount',
        'monthly_balance_before' => 'setMonthlyBalanceBefore',
        'monthly_balance_after' => 'setMonthlyBalanceAfter',
        'purchased_balance_before' => 'setPurchasedBalanceBefore',
        'purchased_balance_after' => 'setPurchasedBalanceAfter',
        'source_bucket' => 'setSourceBucket',
        'monthly_amount' => 'setMonthlyAmount',
        'purchased_amount' => 'setPurchasedAmount',
        'pricing_version' => 'setPricingVersion',
        'description' => 'setDescription',
        'reference_type' => 'setReferenceType',
        'reference_id' => 'setReferenceId',
        'created_at' => 'setCreatedAt',
        'state' => 'setState',
        'state_changed_at' => 'setStateChangedAt',
        'operation_summary' => 'setOperationSummary',
        'operation_count' => 'setOperationCount',
        'primary_filename' => 'setPrimaryFilename'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'type' => 'getType',
        'amount' => 'getAmount',
        'monthly_balance_before' => 'getMonthlyBalanceBefore',
        'monthly_balance_after' => 'getMonthlyBalanceAfter',
        'purchased_balance_before' => 'getPurchasedBalanceBefore',
        'purchased_balance_after' => 'getPurchasedBalanceAfter',
        'source_bucket' => 'getSourceBucket',
        'monthly_amount' => 'getMonthlyAmount',
        'purchased_amount' => 'getPurchasedAmount',
        'pricing_version' => 'getPricingVersion',
        'description' => 'getDescription',
        'reference_type' => 'getReferenceType',
        'reference_id' => 'getReferenceId',
        'created_at' => 'getCreatedAt',
        'state' => 'getState',
        'state_changed_at' => 'getStateChangedAt',
        'operation_summary' => 'getOperationSummary',
        'operation_count' => 'getOperationCount',
        'primary_filename' => 'getPrimaryFilename'
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
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('monthly_balance_before', $data ?? [], null);
        $this->setIfExists('monthly_balance_after', $data ?? [], null);
        $this->setIfExists('purchased_balance_before', $data ?? [], null);
        $this->setIfExists('purchased_balance_after', $data ?? [], null);
        $this->setIfExists('source_bucket', $data ?? [], null);
        $this->setIfExists('monthly_amount', $data ?? [], null);
        $this->setIfExists('purchased_amount', $data ?? [], null);
        $this->setIfExists('pricing_version', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('reference_type', $data ?? [], null);
        $this->setIfExists('reference_id', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('state', $data ?? [], null);
        $this->setIfExists('state_changed_at', $data ?? [], null);
        $this->setIfExists('operation_summary', $data ?? [], null);
        $this->setIfExists('operation_count', $data ?? [], null);
        $this->setIfExists('primary_filename', $data ?? [], null);
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

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['id'])) {
            $invalidProperties[] = "invalid value for 'id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
        }
        if ($this->container['monthly_balance_before'] === null) {
            $invalidProperties[] = "'monthly_balance_before' can't be null";
        }
        if (($this->container['monthly_balance_before'] < 0)) {
            $invalidProperties[] = "invalid value for 'monthly_balance_before', must be bigger than or equal to 0.";
        }

        if ($this->container['monthly_balance_after'] === null) {
            $invalidProperties[] = "'monthly_balance_after' can't be null";
        }
        if (($this->container['monthly_balance_after'] < 0)) {
            $invalidProperties[] = "invalid value for 'monthly_balance_after', must be bigger than or equal to 0.";
        }

        if ($this->container['purchased_balance_before'] === null) {
            $invalidProperties[] = "'purchased_balance_before' can't be null";
        }
        if (($this->container['purchased_balance_before'] < 0)) {
            $invalidProperties[] = "invalid value for 'purchased_balance_before', must be bigger than or equal to 0.";
        }

        if ($this->container['purchased_balance_after'] === null) {
            $invalidProperties[] = "'purchased_balance_after' can't be null";
        }
        if (($this->container['purchased_balance_after'] < 0)) {
            $invalidProperties[] = "invalid value for 'purchased_balance_after', must be bigger than or equal to 0.";
        }

        if ($this->container['source_bucket'] === null) {
            $invalidProperties[] = "'source_bucket' can't be null";
        }
        if ($this->container['monthly_amount'] === null && !$this->isNullableSetToNull('monthly_amount')) {
            $invalidProperties[] = "'monthly_amount' can't be null";
        }
        if ($this->container['purchased_amount'] === null && !$this->isNullableSetToNull('purchased_amount')) {
            $invalidProperties[] = "'purchased_amount' can't be null";
        }
        if ($this->container['pricing_version'] === null) {
            $invalidProperties[] = "'pricing_version' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['reference_type'] === null) {
            $invalidProperties[] = "'reference_type' can't be null";
        }
        if ($this->container['reference_id'] === null) {
            $invalidProperties[] = "'reference_id' can't be null";
        }
        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if (!is_null($this->container['operation_count']) && ($this->container['operation_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'operation_count', must be bigger than or equal to 0.";
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
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }

        if ((!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($id)))) {
            throw new \InvalidArgumentException("invalid value for \$id when calling CreditTransaction., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type Ledger entry type — free-form string. Common values: `reservation`, `refund`, `top_up`, `monthly_grant`, `adjustment`. Not enumerated to avoid contract churn as billing event taxonomy evolves.
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
     * Gets amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param int $amount Signed delta against the caller's total balance. Positive for grants/top-ups, negative for debits/reservations. Equals `monthly_amount + purchased_amount` for ledger entries that touch only those two buckets.
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (is_null($amount)) {
            throw new \InvalidArgumentException('non-nullable amount cannot be null');
        }
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets monthly_balance_before
     *
     * @return int
     */
    public function getMonthlyBalanceBefore()
    {
        return $this->container['monthly_balance_before'];
    }

    /**
     * Sets monthly_balance_before
     *
     * @param int $monthly_balance_before monthly_balance_before
     *
     * @return self
     */
    public function setMonthlyBalanceBefore($monthly_balance_before)
    {
        if (is_null($monthly_balance_before)) {
            throw new \InvalidArgumentException('non-nullable monthly_balance_before cannot be null');
        }

        if (($monthly_balance_before < 0)) {
            throw new \InvalidArgumentException('invalid value for $monthly_balance_before when calling CreditTransaction., must be bigger than or equal to 0.');
        }

        $this->container['monthly_balance_before'] = $monthly_balance_before;

        return $this;
    }

    /**
     * Gets monthly_balance_after
     *
     * @return int
     */
    public function getMonthlyBalanceAfter()
    {
        return $this->container['monthly_balance_after'];
    }

    /**
     * Sets monthly_balance_after
     *
     * @param int $monthly_balance_after monthly_balance_after
     *
     * @return self
     */
    public function setMonthlyBalanceAfter($monthly_balance_after)
    {
        if (is_null($monthly_balance_after)) {
            throw new \InvalidArgumentException('non-nullable monthly_balance_after cannot be null');
        }

        if (($monthly_balance_after < 0)) {
            throw new \InvalidArgumentException('invalid value for $monthly_balance_after when calling CreditTransaction., must be bigger than or equal to 0.');
        }

        $this->container['monthly_balance_after'] = $monthly_balance_after;

        return $this;
    }

    /**
     * Gets purchased_balance_before
     *
     * @return int
     */
    public function getPurchasedBalanceBefore()
    {
        return $this->container['purchased_balance_before'];
    }

    /**
     * Sets purchased_balance_before
     *
     * @param int $purchased_balance_before purchased_balance_before
     *
     * @return self
     */
    public function setPurchasedBalanceBefore($purchased_balance_before)
    {
        if (is_null($purchased_balance_before)) {
            throw new \InvalidArgumentException('non-nullable purchased_balance_before cannot be null');
        }

        if (($purchased_balance_before < 0)) {
            throw new \InvalidArgumentException('invalid value for $purchased_balance_before when calling CreditTransaction., must be bigger than or equal to 0.');
        }

        $this->container['purchased_balance_before'] = $purchased_balance_before;

        return $this;
    }

    /**
     * Gets purchased_balance_after
     *
     * @return int
     */
    public function getPurchasedBalanceAfter()
    {
        return $this->container['purchased_balance_after'];
    }

    /**
     * Sets purchased_balance_after
     *
     * @param int $purchased_balance_after purchased_balance_after
     *
     * @return self
     */
    public function setPurchasedBalanceAfter($purchased_balance_after)
    {
        if (is_null($purchased_balance_after)) {
            throw new \InvalidArgumentException('non-nullable purchased_balance_after cannot be null');
        }

        if (($purchased_balance_after < 0)) {
            throw new \InvalidArgumentException('invalid value for $purchased_balance_after when calling CreditTransaction., must be bigger than or equal to 0.');
        }

        $this->container['purchased_balance_after'] = $purchased_balance_after;

        return $this;
    }

    /**
     * Gets source_bucket
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditTransactionSourceBucket
     */
    public function getSourceBucket()
    {
        return $this->container['source_bucket'];
    }

    /**
     * Sets source_bucket
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditTransactionSourceBucket $source_bucket source_bucket
     *
     * @return self
     */
    public function setSourceBucket($source_bucket)
    {
        if (is_null($source_bucket)) {
            throw new \InvalidArgumentException('non-nullable source_bucket cannot be null');
        }
        $this->container['source_bucket'] = $source_bucket;

        return $this;
    }

    /**
     * Gets monthly_amount
     *
     * @return int|null
     */
    public function getMonthlyAmount()
    {
        return $this->container['monthly_amount'];
    }

    /**
     * Sets monthly_amount
     *
     * @param int|null $monthly_amount Signed portion debited from / credited to the monthly pool. `null` when the monthly bucket did not contribute to this transaction (`source_bucket: purchased` or `source_bucket: overdraft`). Non-null on both `monthly_amount` and `purchased_amount` when `source_bucket: mixed`. May be `0` (not `null`) on the specific `OverdraftRepayment` ledger row that `applyMonthlyGrant()` emits when an inbound grant is fully absorbed by overdraft debt — that row carries `type: overdraft_repayment` + `amount: 0` and distinguishes itself from \"no contribution\" by the non-null zero rather than null.  **Partial-overdraft reconstruction.** A transaction can split across a normal bucket *and* the overdraft pool (e.g. monthly partially covered the cost and the shortfall fell to overdraft). In that case the resolver returns `source_bucket: monthly` / `purchased` / `mixed` based on which normal bucket(s) contributed, NOT `overdraft`. Consumers that need the overdraft contribution can reconstruct it as `abs(amount) - abs(monthly_amount ?? 0) - abs(purchased_amount ?? 0)`; a positive remainder is the overdraft draw. Pure-overdraft rows still have `source_bucket: overdraft` with both fields `null`.
     *
     * @return self
     */
    public function setMonthlyAmount($monthly_amount)
    {
        if (is_null($monthly_amount)) {
            array_push($this->openAPINullablesSetToNull, 'monthly_amount');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('monthly_amount', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['monthly_amount'] = $monthly_amount;

        return $this;
    }

    /**
     * Gets purchased_amount
     *
     * @return int|null
     */
    public function getPurchasedAmount()
    {
        return $this->container['purchased_amount'];
    }

    /**
     * Sets purchased_amount
     *
     * @param int|null $purchased_amount Signed portion debited from / credited to the purchased pool. `null` when the purchased bucket did not contribute to this transaction (`source_bucket: monthly` or `source_bucket: overdraft`). Non-null on both `monthly_amount` and `purchased_amount` when `source_bucket: mixed`. Same `null`-when-not-applicable convention as `monthly_amount`; partial-overdraft reconstruction formula in `monthly_amount` description applies symmetrically.
     *
     * @return self
     */
    public function setPurchasedAmount($purchased_amount)
    {
        if (is_null($purchased_amount)) {
            array_push($this->openAPINullablesSetToNull, 'purchased_amount');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('purchased_amount', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['purchased_amount'] = $purchased_amount;

        return $this;
    }

    /**
     * Gets pricing_version
     *
     * @return string
     */
    public function getPricingVersion()
    {
        return $this->container['pricing_version'];
    }

    /**
     * Sets pricing_version
     *
     * @param string $pricing_version Pricing-table version applied to this transaction. Free-form string (server emits a semver-shaped or date-shaped tag — e.g. `v3.2.0` or `2026-04-01`); SDKs MUST treat opaque. Stable across the transaction's lifetime; refund rows carry the same `pricing_version` as the original reservation so credit/debit reconciliation is deterministic.
     *
     * @return self
     */
    public function setPricingVersion($pricing_version)
    {
        if (is_null($pricing_version)) {
            throw new \InvalidArgumentException('non-nullable pricing_version cannot be null');
        }
        $this->container['pricing_version'] = $pricing_version;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Human-readable description of the ledger entry.
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets reference_type
     *
     * @return string
     */
    public function getReferenceType()
    {
        return $this->container['reference_type'];
    }

    /**
     * Sets reference_type
     *
     * @param string $reference_type What the transaction references. Common values: `workflow`, `top_up`, `cycle_grant`, `adjustment`. Free-form string.
     *
     * @return self
     */
    public function setReferenceType($reference_type)
    {
        if (is_null($reference_type)) {
            throw new \InvalidArgumentException('non-nullable reference_type cannot be null');
        }
        $this->container['reference_type'] = $reference_type;

        return $this;
    }

    /**
     * Gets reference_id
     *
     * @return string
     */
    public function getReferenceId()
    {
        return $this->container['reference_id'];
    }

    /**
     * Sets reference_id
     *
     * @param string $reference_id Identifier of the referenced entity. Typically a UUID v7 for `workflow` references, but other reference types (`top_up` carrying a Stripe payment intent ID, `cycle_grant` carrying a cycle date, etc.) may use non-UUID identifiers. NOT constrained to `UuidV7`.
     *
     * @return self
     */
    public function setReferenceId($reference_id)
    {
        if (is_null($reference_id)) {
            throw new \InvalidArgumentException('non-nullable reference_id cannot be null');
        }
        $this->container['reference_id'] = $reference_id;

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
     * @param \DateTime $created_at created_at
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
     * Gets state
     *
     * @return string|null
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param string|null $state Reservation lifecycle state — free-form string (kept opaque like `type`/`reference_type` for churn-resistance; SDKs duck-type). Current values: `active` (held), `settled` (charged), `released` / `cancelled_released` (refunded / cancelled), `expired`. `null` for non-reservation ledger types. Lets the consumer distinguish an internal HOLD from a final charge rather than showing raw reservations as spends.
     *
     * @return self
     */
    public function setState($state)
    {
        if (is_null($state)) {
            array_push($this->openAPINullablesSetToNull, 'state');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('state', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets state_changed_at
     *
     * @return \DateTime|null
     */
    public function getStateChangedAt()
    {
        return $this->container['state_changed_at'];
    }

    /**
     * Sets state_changed_at
     *
     * @param \DateTime|null $state_changed_at RFC3339 / ISO-8601 timestamp of the last `state` transition. `null` for non-reservation types.
     *
     * @return self
     */
    public function setStateChangedAt($state_changed_at)
    {
        if (is_null($state_changed_at)) {
            array_push($this->openAPINullablesSetToNull, 'state_changed_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('state_changed_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['state_changed_at'] = $state_changed_at;

        return $this;
    }

    /**
     * Gets operation_summary
     *
     * @return string|null
     */
    public function getOperationSummary()
    {
        return $this->container['operation_summary'];
    }

    /**
     * Sets operation_summary
     *
     * @param string|null $operation_summary Distinct canonical operation type(s) for the referenced workflow, comma-joined (e.g. `\"compress\"` or `\"convert, compress\"`). `null` for legacy rows + non-reservation types. Human-label input.
     *
     * @return self
     */
    public function setOperationSummary($operation_summary)
    {
        if (is_null($operation_summary)) {
            array_push($this->openAPINullablesSetToNull, 'operation_summary');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('operation_summary', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['operation_summary'] = $operation_summary;

        return $this;
    }

    /**
     * Gets operation_count
     *
     * @return int|null
     */
    public function getOperationCount()
    {
        return $this->container['operation_count'];
    }

    /**
     * Sets operation_count
     *
     * @param int|null $operation_count Count of operations in the referenced workflow. `null` for legacy / non-reservation rows. Human-label input (e.g. \"Compressed 3 images\").
     *
     * @return self
     */
    public function setOperationCount($operation_count)
    {
        if (is_null($operation_count)) {
            array_push($this->openAPINullablesSetToNull, 'operation_count');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('operation_count', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($operation_count) && ($operation_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $operation_count when calling CreditTransaction., must be bigger than or equal to 0.');
        }

        $this->container['operation_count'] = $operation_count;

        return $this;
    }

    /**
     * Gets primary_filename
     *
     * @return string|null
     */
    public function getPrimaryFilename()
    {
        return $this->container['primary_filename'];
    }

    /**
     * Sets primary_filename
     *
     * @param string|null $primary_filename Original filename of the primary (first) input of the referenced workflow. `null` for legacy / non-reservation rows. Human-label input.
     *
     * @return self
     */
    public function setPrimaryFilename($primary_filename)
    {
        if (is_null($primary_filename)) {
            array_push($this->openAPINullablesSetToNull, 'primary_filename');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('primary_filename', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['primary_filename'] = $primary_filename;

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


