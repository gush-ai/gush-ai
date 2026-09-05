# WordPress Gateway

_Auto-generated from `services/wordpress-gateway/manifest.php` by `tools/gen-provider-docs.php`._
_Do not hand-edit — re-run the generator after changing the manifest instead._

> **New page added in this pass:** `services/wordpress-gateway/` had a
> working `manifest.php`, `generate.php`, and `README.md` but no generated
> doc page existed yet. Added here and linked from the index. This
> manifest also carries a few fields (`visibility`, `requires_install`,
> `supports_multi_connection`, `developer`, `permissions`,
> `long_description`) that none of the other installed providers use yet —
> shown below as their own section rather than forced into the standard
> table.

| Field | Value |
|---|---|
| Key | `wordpress-gateway` |
| Folder | `services/wordpress-gateway/` |
| Chat command | `@wordpress` |
| Type | `bridge` |
| Enabled | yes |
| Requires login | yes |
| Billing | free |
| Visual template | no (uses default card) |

Connect your own WordPress site to post, manage pages, and run WooCommerce
actions from chat.

## Install model (why there's no shared config.php)

Unlike most providers here, this one has no `config.php` at all — it
doesn't need shared credentials. Each user connects their **own**
WordPress site from the Provider Store, and that connection (site URL +
credential) is stored per-account in `user_service_installs`, scoped to
that user's `user_id` only. Nobody else — not even an admin — can read or
run another user's connection through the normal `service_run` path.

| Manifest field | Value |
|---|---|
| `visibility` | `public` — any logged-in user can discover and install it |
| `requires_install` | `true` — a user must connect their own site before running it |
| `supports_multi_connection` | `true` — one user can connect more than one site, selected by `install_key` |
| `developer` | Gush AI Core Team |

## Permissions shown at install time

Shown verbatim in the install/details modal so a user knows exactly what
they're granting before connecting their site:

- Read and create posts/pages on the connected WordPress site
- Read and create WooCommerce products/orders (if WooCommerce is installed)
- Stores your site URL and credential, scoped privately to your account only
- Never posts, edits, or deletes anything without an explicit chat command

## Actions

| action | what it does |
|---|---|
| `test_connection` | Verifies the stored credential still works. |
| `list_posts` | `{ query?, limit? }` → recent/matching posts. |
| `create_post` | `{ title, content, status? }` → publishes/drafts a post. |
| `list_pages` | Lists pages. |
| `woo_list_products` | `{ limit? }` → returns `{ products: [...] }` (default shopping card grid). Requires WooCommerce's own REST consumer key/secret. |
| `woo_create_product` / `woo_list_orders` | Documented, not yet implemented. |

## Calling it

```
POST /?action=service_run
Content-Type: application/json

{ "service": "wordpress-gateway", "input": { "action": "list_posts" } }
```

Pass `{"install_key": "..."}` alongside the action if a user has more than
one connected site; if they only have one, it's picked automatically.

## Authentication method

Connections use WordPress **Application Passwords** (WP 5.6+): a user
generates one under *Users → Profile → Application Passwords* and enters
the site URL + WordPress username + generated password, used as HTTP
Basic auth on every request. The alternate "request access from WP" flow
described in the manifest's permissions UI is not implemented yet —
`generate.php` returns a clear error rather than failing silently if a
user picks it today.

WooCommerce's REST API uses its own separate consumer key/secret pair
(WooCommerce → Settings → Advanced → REST API), not the WP Application
Password — see `services/wordpress-gateway/README.md` for what's needed
to wire up the `woo_*` actions.

## Full details

See `services/wordpress-gateway/README.md` for full setup and the
WooCommerce credential note above.
