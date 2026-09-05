# Music Player

_Auto-generated from `services/music/manifest.php` by `tools/gen-provider-docs.php`._
_Do not hand-edit — re-run the generator after changing the manifest instead._

> **New page added in this pass:** `services/music/` already had a working
> `manifest.php` and `generate.php` but no generated doc page existed yet —
> it was missing from `doc/provider-documentation/` entirely. Added here
> and linked from the index.

| Field | Value |
|---|---|
| Key | `music` |
| Folder | `services/music/` |
| Chat command | `@music` |
| Type | `media` |
| Enabled | yes |
| Requires login | no |
| Billing | free |
| Visual template | yes — scope `gsc-tpl-music` |

Apple Music style streaming player with rich artwork, equalizer animations,
and persistent background playback. Talks to a fixed public endpoint
(`api.sstore.ng`) by default — no API key required.

## Actions

- `search`
- `list_tracks`
- `track_details`
- `trending`
- `albums`

## Calling it

```
POST /?action=service_run
Content-Type: application/json

{ "service": "music", "input": { "action": "search" } }
```

## Configuration

This provider does **not** ship a `config.php.example`. `services/music/`
has a `config.php` that can optionally override the `endpoint` URL
`generate.php` calls — if the file is missing or doesn't set `endpoint`,
the built-in default endpoint is used, so this file is optional rather
than required setup. As with every provider here, this document never
shows config.php contents.

## Visual template

This provider renders with its own card/modal design instead of the
default media card.

- CSS: `services/music/template/style.css`
- JS: `services/music/template/render.js`
- Scope class: `gsc-tpl-music`

See `HOW-TO-BUILD-A-PROVIDER.md` for the template contract.
