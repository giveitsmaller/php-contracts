# giveitsmaller/contracts (Composer)

**Generated contract types for GISL (Give It Smaller).** Do not edit — this package is produced by
`scripts/generate.py` in the `giveitsmaller-sdks` repo and regenerated on every contracts re-vendor.

| | |
|---|---|
| Package version | `0.64.0` |
| Generated from spec | **`v2.193.0`** |

## Two version lines, and they are not comparable

This package is on an **0.x** line. The contract it is generated from is on a **2.x** line. They
count independently and nothing in either name says so, so:

- `npm view` / `composer show` tells you the PACKAGE version, never the spec version.
- To find the spec version, read **`gislContractsSpec`** in `package.json` (npm) or
  **`extra.gisl-contracts-spec`** in `composer.json` (Composer), or the table above.

⚠️ **If `gislContractsSpec` is absent, this package is 0.62.0 or older — it does NOT mean you have
the wrong package.** The field was introduced after 0.62.0.

## What is in here

- `openapi/api.yaml`, `asyncapi/events.yaml` — the specs themselves.
- `dist/` — generated TypeScript types for both, plus the operation schemas.
- `availability/availability.json` — per-endpoint availability. **`planned` means the endpoint is
  declared but not necessarily implemented or routed**; check before building against it.

## Related packages

`giveitsmaller/contracts` on Packagist is the PHP build of this same generated output and shares
these version numbers. `antoniocs/compression-contracts` is a DIFFERENT package — the 2.x Composer
package carrying the spec for the PHP API — and its numbers are the spec numbers, not these.
