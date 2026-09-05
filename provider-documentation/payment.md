# Wallet Top-Up (Paystack)

_Auto-generated from `services/payment/manifest.php` by `tools/gen-provider-docs.php`._
_Do not hand-edit — re-run the generator after changing the manifest instead._

> **This page was rewritten in this pass.** The previous `payment.md` only
> covered the calling convention. Since this is the one provider that
> touches money, this version adds an explicit **Security** section below,
> reviewed against the current `generate.php` / `config.php.example` /
> `README.md` in `services/payment/`. Provided by Olayiwola Emmanuel.

| Field | Value |
|---|---|
| Key | `payment` |
| Folder | `services/payment/` |
| Chat command | `@topup` |
| Type | `payment` |
| Enabled | yes |
| Requires login | yes |
| Billing | free |
| Visual template | no (uses default card) |

Fund your Gush AI wallet balance in-app via Paystack — cards, bank transfer, USSD.

## Calling it

Payment-type services use two dedicated actions instead of the generic
`?action=service_run`:

```
POST /?action=payment_init
Content-Type: application/json

{ "amount": 1000 }
```

```
GET /?action=payment_verify&reference=...
```

`main.php` records a `pending` row in `user_wallet_transactions` right
after `init`, then only credits `users.wallet_balance` after `verify`
confirms success — see `services/payment/README.md` for the full
init → redirect → callback → verify sequence.

## Security

This section documents the safeguards already present in `generate.php` /
`config.php.example`, plus a few gaps worth closing before this provider
handles real traffic at scale.

**Already in place:**

- **The secret key never leaves the server.** Only `generate.php` (called
  server-side from `main.php`) reads `config.php`; it's never included in
  any JSON response sent back to the browser, and `public_key` is stored
  for reference only — nothing server-side currently sends it to the
  client either.
- **Wallet crediting never trusts the client.** A `verify` call always
  re-checks the transaction against Paystack's own
  `GET /transaction/verify/<reference>` before `main.php` credits a
  balance — the frontend cannot simply claim success.
- **Placeholder keys fail loudly.** `generate.php` refuses to run if
  `secret_key` is empty or still carries a `YOUR_`/`REPLACE_`/`CHANGE_`
  prefix, so a forgotten setup step can't silently process real payments
  against a dummy key.
- **Transport is enforced.** Every Paystack call sets
  `CURLOPT_SSL_VERIFYPEER` / `CURLOPT_SSL_VERIFYHOST`, so a
  misconfigured or spoofed TLS endpoint fails the request instead of
  silently downgrading.
- **No card data ever reaches Gush AI's servers.** The user pays on
  Paystack's own hosted checkout page (`authorization_url`); this
  provider only ever sees an amount, a reference, and a status —
  card/bank details are entirely out of scope here, which keeps PCI
  exposure on Paystack's side rather than this codebase's.
- **Amounts stay in Naira until the last step.** The ×100 kobo conversion
  happens only right at the Paystack API boundary inside `generate.php`,
  reducing the chance of a unit-mismatch bug elsewhere crediting the
  wrong amount.

**Worth adding before scaling this up:**

- **Webhook verification, not just the redirect callback.** Right now
  crediting relies on the browser being redirected back to
  `?action=payment_verify`. If a user closes the tab after paying but
  before the redirect completes, that transaction may never get verified.
  Paystack's server-to-server webhook (`x-paystack-signature` header,
  HMAC-SHA512 of the raw body with the secret key) is the standard fix —
  it fires regardless of what the browser does, and validating that
  signature server-side is what confirms the webhook really came from
  Paystack and not a spoofed request to an endpoint someone guessed.
- **Rate limiting `payment_init`.** Nothing in `generate.php` currently
  throttles how often one account (or one IP) can call `init` — worth
  adding at the `main.php` layer to blunt abuse/enumeration attempts
  against the minimum-amount check.
- **Reference collision handling.** `init` generates
  `gush_<16 hex chars>` when the caller doesn't supply one, which is fine
  entropy-wise, but confirm `main.php`'s insert into
  `user_wallet_transactions` treats `reference` as unique (DB constraint,
  not just convention) so a retried request can't double-credit.
- **Log hygiene.** Nothing in `generate.php` currently logs the secret
  key, and it shouldn't — if request/response logging is ever added
  around `paystackHttp()`, keep the `Authorization` header and full
  Paystack response body (which can include payer email/card metadata)
  out of any persisted log.

## Configuration

This provider ships `config.php.example` — copy it to `config.php` inside
`services/payment/` and fill in real credentials. **This document never
shows config.php contents** — it is generated from `manifest.php` only,
which never holds secrets by convention.

## Full details

See `services/payment/README.md` for the full end-to-end flow and the
provider-switching notes.
