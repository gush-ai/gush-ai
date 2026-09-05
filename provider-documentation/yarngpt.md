# YarnGPT Voice

_Auto-generated from `services/yarngpt/manifest.php` by `tools/gen-provider-docs.php`._
_Do not hand-edit — re-run the generator after changing the manifest instead._

| Field | Value |
|---|---|
| Key | `yarngpt` |
| Folder | `services/yarngpt/` |
| Chat command | `@voice` |
| Type | `voice` |
| Enabled | yes |
| Requires login | yes |
| Billing | ₦20 after 3 free use(s) |
| Visual template | no (uses default card) |

Generate Nigerian voice audio with YarnGPT.

## Calling it

Voice uses its own dedicated action instead of the generic
`?action=service_run` (see `/services/README.md` §3.2):

```
POST /?action=generate_speech
```

## Configuration

> **Drift fixed in this pass:** the previous page said this provider
> "ships `config.php.example`" — it doesn't. `services/yarngpt/` currently
> contains only `config.php` directly, with no placeholder scaffold and no
> `README.md`. That's worth closing before this provider is shared or
> handed to anyone else: a real `config.php` with live credentials sitting
> in the folder with nothing marking which fields are secret is easy to
> commit by accident. Add a `config.php.example` (placeholder values only,
> `YOUR_`/`REPLACE_`/`CHANGE_`-prefixed, same convention every other
> provider here uses) and a short `README.md` the next time this provider
> is touched.

**This document never shows config.php contents** — it is generated from
`manifest.php` only, which never holds secrets by convention.
