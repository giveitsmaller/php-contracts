<?php
/**
 * CreditQuote
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
 * The version of the OpenAPI document: 2.246.0
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
 * CreditQuote Class Doc Comment
 *
 * @category Class
 * @description The maximum-reservation quote for a workflow (owner decision 832): the most the workflow can ever be charged (&#x60;max_hold_credits&#x60;), shown and locked before execution, and how much of it is currently held, charged and released. The final charge is never above the hold; whatever is not charged is released. There is no fixed price.  Design: &#x60;Plans/2026-10-16 1108 - Reservation quote contract (OLxqswx1).md&#x60; in the owner vault (section 2 as amended by r3 A, B, D, F, M).  **Availability: &#x60;planned&#x60;.** Declared contract-first; the API does not emit it yet. Until it does, &#x60;quote&#x60; is absent from the workflow create and status responses and &#x60;GET /api/workflows/{id}/quote&#x60; is not served.  **Who gets one.** A quote exists only for a workflow reserved under PER-JOB settlement (a job&#39;s lines are charged or released on that job&#39;s own outcome, owner decision 635(1)). A workflow under whole-workflow refund, and every legacy workflow whose reservation predates quotes, has NO quote: &#x60;quote&#x60; is ABSENT from its responses (never &#x60;null&#x60;, never an empty object) and &#x60;GET /api/workflows/{id}/quote&#x60; answers 404.  **Invariants (normative, every version, every state).** With &#x60;held&#x60;, &#x60;charged&#x60;, &#x60;released&#x60; and &#x60;max_hold&#x60; the four workflow amounts: - per line: &#x60;charged_credits + released_credits &lt;&#x3D; max_credits&#x60;; - &#x60;charged_credits &#x3D;&#x3D; sum(lines[].charged_credits)&#x60;; - &#x60;released_credits &#x3D;&#x3D; sum(lines[].released_credits)&#x60;; - &#x60;held_credits &#x3D;&#x3D; sum(max_credits - charged_credits - released_credits)&#x60;   over the lines whose &#x60;state&#x60; is &#x60;held&#x60; (a &#x60;paused&#x60; or &#x60;quoted&#x60; line   holds nothing); - &#x60;charged + released + held &lt;&#x3D; max_hold&#x60;; - &#x60;max_hold_credits &#x3D;&#x3D; sum(lines[].max_credits)&#x60;; - once &#x60;final&#x60; is true: &#x60;charged + released &#x3D;&#x3D; max_hold&#x60; (every credit   of the hold is either charged or released), and on every line   &#x60;charged_credits + released_credits &#x3D;&#x3D; max_credits&#x60;. Quoted ceilings (&#x60;max_credits&#x60;, &#x60;max_hold_credits&#x60;) never rise after acceptance; amounts move only within them.  **Versions are snapshots.** Only the CURRENT version (the one with &#x60;status: accepted&#x60;) is live. A version is frozen at the moment it is superseded: &#x60;status: superseded&#x60;, its own &#x60;max_hold_credits&#x60;, and the amounts it held then. The &#x60;final&#x60; equality above applies to the current version only.  **Unknown enum values.** &#x60;status&#x60;, &#x60;lines[].state&#x60; and &#x60;lines[].outcome&#x60; are CLOSED enums, but a value may be added in a minor contract version. A consumer MUST NOT crash on a value it does not recognise; it falls back to showing &#x60;max_hold_credits&#x60; (the most the workflow can cost), which is true whatever the unrecognised value means.  The amounts are integers in credits. &#x60;pricing_version&#x60; names the price table the ceilings were computed from.
 * @package  Gisl\Generated\OpenApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreditQuote implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CreditQuote';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'quote_id' => 'string',
        'quote_version' => 'int',
        'workflow_id' => 'string',
        'status' => '\Gisl\Generated\OpenApi\Model\CreditQuoteStatus',
        'expires_at' => '\DateTime',
        'max_hold_credits' => 'int',
        'held_credits' => 'int',
        'charged_credits' => 'int',
        'released_credits' => 'int',
        'final' => 'bool',
        'settlement_pending' => 'bool',
        'pricing_version' => 'string',
        'meter' => '\Gisl\Generated\OpenApi\Model\CreditQuoteMeter',
        'lines' => '\Gisl\Generated\OpenApi\Model\CreditQuoteLine[]',
        'affordability' => '\Gisl\Generated\OpenApi\Model\CreditQuoteAffordability'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'quote_id' => 'uuid',
        'quote_version' => null,
        'workflow_id' => 'uuid',
        'status' => null,
        'expires_at' => 'date-time',
        'max_hold_credits' => null,
        'held_credits' => null,
        'charged_credits' => null,
        'released_credits' => null,
        'final' => null,
        'settlement_pending' => null,
        'pricing_version' => null,
        'meter' => null,
        'lines' => null,
        'affordability' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'quote_id' => false,
        'quote_version' => false,
        'workflow_id' => true,
        'status' => false,
        'expires_at' => true,
        'max_hold_credits' => false,
        'held_credits' => false,
        'charged_credits' => false,
        'released_credits' => false,
        'final' => false,
        'settlement_pending' => false,
        'pricing_version' => false,
        'meter' => true,
        'lines' => false,
        'affordability' => true
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
        'quote_id' => 'quote_id',
        'quote_version' => 'quote_version',
        'workflow_id' => 'workflow_id',
        'status' => 'status',
        'expires_at' => 'expires_at',
        'max_hold_credits' => 'max_hold_credits',
        'held_credits' => 'held_credits',
        'charged_credits' => 'charged_credits',
        'released_credits' => 'released_credits',
        'final' => 'final',
        'settlement_pending' => 'settlement_pending',
        'pricing_version' => 'pricing_version',
        'meter' => 'meter',
        'lines' => 'lines',
        'affordability' => 'affordability'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'quote_id' => 'setQuoteId',
        'quote_version' => 'setQuoteVersion',
        'workflow_id' => 'setWorkflowId',
        'status' => 'setStatus',
        'expires_at' => 'setExpiresAt',
        'max_hold_credits' => 'setMaxHoldCredits',
        'held_credits' => 'setHeldCredits',
        'charged_credits' => 'setChargedCredits',
        'released_credits' => 'setReleasedCredits',
        'final' => 'setFinal',
        'settlement_pending' => 'setSettlementPending',
        'pricing_version' => 'setPricingVersion',
        'meter' => 'setMeter',
        'lines' => 'setLines',
        'affordability' => 'setAffordability'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'quote_id' => 'getQuoteId',
        'quote_version' => 'getQuoteVersion',
        'workflow_id' => 'getWorkflowId',
        'status' => 'getStatus',
        'expires_at' => 'getExpiresAt',
        'max_hold_credits' => 'getMaxHoldCredits',
        'held_credits' => 'getHeldCredits',
        'charged_credits' => 'getChargedCredits',
        'released_credits' => 'getReleasedCredits',
        'final' => 'getFinal',
        'settlement_pending' => 'getSettlementPending',
        'pricing_version' => 'getPricingVersion',
        'meter' => 'getMeter',
        'lines' => 'getLines',
        'affordability' => 'getAffordability'
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
        $this->setIfExists('quote_id', $data ?? [], null);
        $this->setIfExists('quote_version', $data ?? [], null);
        $this->setIfExists('workflow_id', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('expires_at', $data ?? [], null);
        $this->setIfExists('max_hold_credits', $data ?? [], null);
        $this->setIfExists('held_credits', $data ?? [], null);
        $this->setIfExists('charged_credits', $data ?? [], null);
        $this->setIfExists('released_credits', $data ?? [], null);
        $this->setIfExists('final', $data ?? [], null);
        $this->setIfExists('settlement_pending', $data ?? [], null);
        $this->setIfExists('pricing_version', $data ?? [], null);
        $this->setIfExists('meter', $data ?? [], null);
        $this->setIfExists('lines', $data ?? [], null);
        $this->setIfExists('affordability', $data ?? [], null);
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

        if ($this->container['quote_id'] === null) {
            $invalidProperties[] = "'quote_id' can't be null";
        }
        if ($this->container['quote_version'] === null) {
            $invalidProperties[] = "'quote_version' can't be null";
        }
        if (($this->container['quote_version'] < 1)) {
            $invalidProperties[] = "invalid value for 'quote_version', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['workflow_id']) && !preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", $this->container['workflow_id'])) {
            $invalidProperties[] = "invalid value for 'workflow_id', must be conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.";
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if ($this->container['max_hold_credits'] === null) {
            $invalidProperties[] = "'max_hold_credits' can't be null";
        }
        if (($this->container['max_hold_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'max_hold_credits', must be bigger than or equal to 0.";
        }

        if ($this->container['held_credits'] === null) {
            $invalidProperties[] = "'held_credits' can't be null";
        }
        if (($this->container['held_credits'] < 0)) {
            $invalidProperties[] = "invalid value for 'held_credits', must be bigger than or equal to 0.";
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

        if ($this->container['final'] === null) {
            $invalidProperties[] = "'final' can't be null";
        }
        if ($this->container['settlement_pending'] === null) {
            $invalidProperties[] = "'settlement_pending' can't be null";
        }
        if ($this->container['pricing_version'] === null) {
            $invalidProperties[] = "'pricing_version' can't be null";
        }
        if ($this->container['lines'] === null) {
            $invalidProperties[] = "'lines' can't be null";
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
     * Gets quote_id
     *
     * @return string
     */
    public function getQuoteId()
    {
        return $this->container['quote_id'];
    }

    /**
     * Sets quote_id
     *
     * @param string $quote_id Identifier of the quote. Every version of one quote shares it.
     *
     * @return self
     */
    public function setQuoteId($quote_id)
    {
        if (is_null($quote_id)) {
            throw new \InvalidArgumentException('non-nullable quote_id cannot be null');
        }
        $this->container['quote_id'] = $quote_id;

        return $this;
    }

    /**
     * Gets quote_version
     *
     * @return int
     */
    public function getQuoteVersion()
    {
        return $this->container['quote_version'];
    }

    /**
     * Sets quote_version
     *
     * @param int $quote_version Version of this quote, starting at 1. A later version replaces the earlier one, which becomes `superseded`.
     *
     * @return self
     */
    public function setQuoteVersion($quote_version)
    {
        if (is_null($quote_version)) {
            throw new \InvalidArgumentException('non-nullable quote_version cannot be null');
        }

        if (($quote_version < 1)) {
            throw new \InvalidArgumentException('invalid value for $quote_version when calling CreditQuote., must be bigger than or equal to 1.');
        }

        $this->container['quote_version'] = $quote_version;

        return $this;
    }

    /**
     * Gets workflow_id
     *
     * @return string|null
     */
    public function getWorkflowId()
    {
        return $this->container['workflow_id'];
    }

    /**
     * Sets workflow_id
     *
     * @param string|null $workflow_id UUID v7 format identifier (time-ordered)
     *
     * @return self
     */
    public function setWorkflowId($workflow_id)
    {
        if (is_null($workflow_id)) {
            array_push($this->openAPINullablesSetToNull, 'workflow_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('workflow_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($workflow_id) && (!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/", ObjectSerializer::toString($workflow_id)))) {
            throw new \InvalidArgumentException("invalid value for \$workflow_id when calling CreditQuote., must conform to the pattern /^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/.");
        }

        $this->container['workflow_id'] = $workflow_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteStatus $status status
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
     * Gets expires_at
     *
     * @return \DateTime|null
     */
    public function getExpiresAt()
    {
        return $this->container['expires_at'];
    }

    /**
     * Sets expires_at
     *
     * @param \DateTime|null $expires_at When an `open` quote stops being acceptable. `null` (or absent) once the quote is no longer `open`.
     *
     * @return self
     */
    public function setExpiresAt($expires_at)
    {
        if (is_null($expires_at)) {
            array_push($this->openAPINullablesSetToNull, 'expires_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('expires_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['expires_at'] = $expires_at;

        return $this;
    }

    /**
     * Gets max_hold_credits
     *
     * @return int
     */
    public function getMaxHoldCredits()
    {
        return $this->container['max_hold_credits'];
    }

    /**
     * Sets max_hold_credits
     *
     * @param int $max_hold_credits The most this workflow can ever be charged, and the amount reserved at acceptance. Equals `sum(lines[].max_credits)`. Never rises for a workflow.
     *
     * @return self
     */
    public function setMaxHoldCredits($max_hold_credits)
    {
        if (is_null($max_hold_credits)) {
            throw new \InvalidArgumentException('non-nullable max_hold_credits cannot be null');
        }

        if (($max_hold_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $max_hold_credits when calling CreditQuote., must be bigger than or equal to 0.');
        }

        $this->container['max_hold_credits'] = $max_hold_credits;

        return $this;
    }

    /**
     * Gets held_credits
     *
     * @return int
     */
    public function getHeldCredits()
    {
        return $this->container['held_credits'];
    }

    /**
     * Sets held_credits
     *
     * @param int $held_credits Credits currently reserved and neither charged nor released. `0` while the workflow is paused (paused lines hold nothing).
     *
     * @return self
     */
    public function setHeldCredits($held_credits)
    {
        if (is_null($held_credits)) {
            throw new \InvalidArgumentException('non-nullable held_credits cannot be null');
        }

        if (($held_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $held_credits when calling CreditQuote., must be bigger than or equal to 0.');
        }

        $this->container['held_credits'] = $held_credits;

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
     * @param int $charged_credits Credits charged so far. Equals `sum(lines[].charged_credits)`.
     *
     * @return self
     */
    public function setChargedCredits($charged_credits)
    {
        if (is_null($charged_credits)) {
            throw new \InvalidArgumentException('non-nullable charged_credits cannot be null');
        }

        if (($charged_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $charged_credits when calling CreditQuote., must be bigger than or equal to 0.');
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
     * @param int $released_credits Credits released for good (failed, cancelled, never started, already-optimal, or the unused part of a line charged below its ceiling). Equals `sum(lines[].released_credits)`.
     *
     * @return self
     */
    public function setReleasedCredits($released_credits)
    {
        if (is_null($released_credits)) {
            throw new \InvalidArgumentException('non-nullable released_credits cannot be null');
        }

        if (($released_credits < 0)) {
            throw new \InvalidArgumentException('invalid value for $released_credits when calling CreditQuote., must be bigger than or equal to 0.');
        }

        $this->container['released_credits'] = $released_credits;

        return $this;
    }

    /**
     * Gets final
     *
     * @return bool
     */
    public function getFinal()
    {
        return $this->container['final'];
    }

    /**
     * Sets final
     *
     * @param bool $final `true` once settlement has COMPLETED for this workflow: the amounts no longer move, and `charged_credits + released_credits == max_hold_credits`. NOT the same as a terminal workflow status; see `settlement_pending`. Never `true` together with `settlement_pending`.
     *
     * @return self
     */
    public function setFinal($final)
    {
        if (is_null($final)) {
            throw new \InvalidArgumentException('non-nullable final cannot be null');
        }
        $this->container['final'] = $final;

        return $this;
    }

    /**
     * Gets settlement_pending
     *
     * @return bool
     */
    public function getSettlementPending()
    {
        return $this->container['settlement_pending'];
    }

    /**
     * Sets settlement_pending
     *
     * @param bool $settlement_pending `true` while the workflow is terminal but its settlement has not completed yet (the API's recovery window; settlement may land after `completed_at`). While pending, amounts may still move within the invariants. `false` before the workflow is terminal and once `final` is `true`.
     *
     * @return self
     */
    public function setSettlementPending($settlement_pending)
    {
        if (is_null($settlement_pending)) {
            throw new \InvalidArgumentException('non-nullable settlement_pending cannot be null');
        }
        $this->container['settlement_pending'] = $settlement_pending;

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
     * @param string $pricing_version The price-table version the ceilings were computed from. The SAME identifier as `CreditTransaction.pricing_version` on the ledger rows of this workflow; compare it for equality only.
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
     * Gets meter
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteMeter|null
     */
    public function getMeter()
    {
        return $this->container['meter'];
    }

    /**
     * Sets meter
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteMeter|null $meter meter
     *
     * @return self
     */
    public function setMeter($meter)
    {
        if (is_null($meter)) {
            array_push($this->openAPINullablesSetToNull, 'meter');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('meter', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['meter'] = $meter;

        return $this;
    }

    /**
     * Gets lines
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteLine[]
     */
    public function getLines()
    {
        return $this->container['lines'];
    }

    /**
     * Sets lines
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteLine[] $lines One line per canonical operation node of each PUBLIC job, in job order and then chain order. A long-form fan-out is ONE line.
     *
     * @return self
     */
    public function setLines($lines)
    {
        if (is_null($lines)) {
            throw new \InvalidArgumentException('non-nullable lines cannot be null');
        }
        $this->container['lines'] = $lines;

        return $this;
    }

    /**
     * Gets affordability
     *
     * @return \Gisl\Generated\OpenApi\Model\CreditQuoteAffordability|null
     */
    public function getAffordability()
    {
        return $this->container['affordability'];
    }

    /**
     * Sets affordability
     *
     * @param \Gisl\Generated\OpenApi\Model\CreditQuoteAffordability|null $affordability affordability
     *
     * @return self
     */
    public function setAffordability($affordability)
    {
        if (is_null($affordability)) {
            array_push($this->openAPINullablesSetToNull, 'affordability');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('affordability', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['affordability'] = $affordability;

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


