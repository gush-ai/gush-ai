# Post Share

_Auto-generated from `services/post-share/manifest.php` by `tools/gen-provider-docs.php`._
_Do not hand-edit — re-run the generator after changing the manifest instead._

> **New page added in this pass:** `services/post-share/` had a working
> `manifest.php`, `generate.php`, and `README.md` but no generated doc page
> existed yet. Added here and linked from the index.

| Field | Value |
|---|---|
| Key | `post-share` |
| Folder | `services/post-share/` |
| Chat command | `@post` |
| Type | `content` |
| Enabled | yes |
| Requires login | yes |
| Billing | free |
| Visual template | no (uses default card) |

Share a post (title + content) from chat straight to the site's post
database. Logged-in users and admins only — guests can't post. Admin status
is always taken from the server-verified session, never from client input.

## Actions

- `post`

## Calling it

Accepts either raw chat-format text or explicit fields:

```
POST /?action=service_run
Content-Type: application/json

{ "service": "post-share", "input": { "text": "//My Title//\n//Section: News//\nBody content here." } }
```

```
POST /?action=service_run
Content-Type: application/json

{ "service": "post-share", "input": { "title": "My Title", "content": "Body content here.", "section": "News", "category": "Product Updates" } }
```

Explicit `title`/`content` fields win over a `text` blob when both are
present.

## Configuration

> **Gap found in this pass:** `README.md` for this provider instructs
> "Copy `config.php.example` to `config.php`" and describes `post_api_url`
> / `api_key` settings, but neither `config.php` nor `config.php.example`
> currently ships in `services/post-share/`. Add the missing
> `config.php.example` (placeholder `post_api_url` and `api_key` values)
> before this provider is deployed anywhere — right now there is nothing in
> the repo marking those two fields as secret, and no scaffold pointing a
> new deployer at what to fill in.

## Full details

See `services/post-share/README.md` for the full content-format contract
and the reference `post.php` endpoint implementation.
