# Gush AI

**The premier indigenous foundational large language model platform, built from the ground up in Nigeria by the Gushed Systems team.**

🌐 Live product: **[ai.sstore.ng](https://ai.sstore.ng)**
📖 API documentation: **[ai.sstore.ng/doc](https://ai.sstore.ng/doc)**
📸 Instagram: **[@gush.ai_](https://instagram.com/gush.ai_)**
📍 Sangotedo, Lagos, Nigeria

---

## What is Gush AI?

Gush AI is a full AI workspace, not just a chatbot. On top of a conversational assistant, it ships an extensible **provider framework** that lets a single chat surface reach into live data, commerce, payments, voice, and third‑party apps — plus tooling to generate, edit, and reuse paid documents, and a marketplace where anyone can install or publish new capabilities.

## Features

### 💬 Conversational AI Core
- Multi‑turn chat with per‑thread memory and a "Brain Memory Vault" for longer‑term recall across conversations
- Project workspaces to keep related threads and context together
- Guest mode and full account login, with chat history kept correctly isolated per identity — a guest session never bleeds into an account you log into afterward, and switching accounts always starts clean

### 🔌 Provider / Service Framework
Gush AI's chat understands `@commands` that hand off to installable **providers** — each one a self‑contained service with its own manifest, pricing, and (optionally) its own custom-branded UI template:

| Command | What it does |
|---|---|
| `@store` / `@shop` | E‑commerce bridge — browse and buy products inline in chat |
| `@bet365` | Live sports scores and fixtures, rendered as a scoreboard, not raw data |
| `@topup` | Wallet top‑up via Paystack |
| `@voice` | Text‑to‑voice powered by YarnGPT, with selectable voices |
| `@api` | Bridge to external/custom APIs |

New providers are shape‑based, not hardcoded — any service that returns a recognized response shape (a product list, a live‑match list, etc.) is automatically rendered well, and can ship its own CSS/JS template for a fully custom look.

### 📄 Paid Document Generation
- Generate polished documents (reports, letters, contracts, and more) on demand
- Full‑screen preview with inline **editing** and **saving** — no need to regenerate to fix a typo
- A personal **file manager** keeps every generated document so it can be reopened and reused later instead of being paid for and generated again

### 🛍️ GOS Apps Marketplace
- A launcher ("GOS") where installed providers and community‑built mini‑apps open full‑screen, app‑style
- Publish your own mini‑app or provider and reach other Gush AI users
- Wallet‑based economy underneath: balances, transfers, and revenue share for creators

### 🗄️ Storage & Integrations
- Universal Bucket Storage (S3/R2‑compatible) for a personal AI agent's files
- **Gush Connect** SDKs (Python, JavaScript/Node.js, Go) for triggering background agent tasks and wiring up OpenAPI‑described tools from your own backend
- GCodex — quick app launching for connected tools

---

## Explore the code

| Repository | Description |
|---|---|
| [gush-ai/gush-ai](https://github.com/gush-ai/gush-ai) | Org profile — also ships the **Gush AI E‑Commerce Chatbot**, a WooCommerce shopping‑assistant plugin powered by the Gush AI Cognitive Gateway |
| [Gush-connect](https://github.com/gush-ai/Gush-connect) | Official SDKs & integration hub (Python, JS/Node, Go) for triggering Gush AI agent tasks from your own systems |
| [gush-ai-php-api](https://github.com/gush-ai/gush-ai-php-api) | Official PHP client and secure server‑side proxy for the Gush AI Developer API — keeps your API token off the browser |
| [gush-ai-wp-post-agent](https://github.com/gush-ai/gush-ai-wp-post-agent) | WordPress plugin that generates posts, pages, and WooCommerce product descriptions using Gush AI (and other providers) |
| [gush-blog-contributor-api](https://github.com/gush-ai/gush-blog-contributor-api) | GitHub Actions automation for publishing to the Gush AI Journal |
| [chat](https://github.com/gush-ai/chat) | Early‑stage project scaffold |

> The org currently lists 11 repositories in total; GitHub's repository‑browsing page couldn't be crawled to enumerate the remaining ones, so only the repos above (and any pinned/linked from them) are reflected here. Check **[github.com/gush-ai?tab=repositories](https://github.com/gush-ai?tab=repositories)** directly for the full list.

---

## Getting API Access

1. Visit the [Gush AI developer docs](https://ai.sstore.ng/doc) for the full API reference (`/generate-content`, `/models`, `/usage`, and more).
2. For WooCommerce/e‑commerce integrations specifically, generate a token at the [Gush AI Gateway](https://api.sstore.ng/api/store/api-access).
3. Never expose your API token in client‑side code — route requests through a server‑side proxy, such as the one in [gush-ai-php-api](https://github.com/gush-ai/gush-ai-php-api).

## License

Individual repositories carry their own licenses (GPL‑2.0 or MIT — see each repo). Check the repository you intend to use before redistributing.

## Support

- General support: support@sstore.com.ng
- Security disclosures: security@sstore.com.ng
