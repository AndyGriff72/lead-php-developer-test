# Test for Lead Laravel / PHP Developer (3-Day Version)

This test assesses your ability to design and deliver production-quality Laravel systems as a technical lead.  
The focus is on architecture, judgement, and code quality rather than raw feature volume.

The test is divided into three progressive levels. Each level builds on the previous one and must be completed in order.

---

## Scoring

Total: 150 points

| Area                                   | Points |
|----------------------------------------|--------|
| Implementation quality                 | 70     |
| Architecture & technical judgement     | 50     |
| Testing strategy & delivery discipline | 30     |
| **Total**                              | **150**|

Passing score: 115

---

## Duration

You have 3 days to complete the test.

Log time spent per task in `/docs/time-log.md`.

---

## Submission

Provide a link to a public Git repository.

Your commit history will be reviewed. Small, meaningful commits are expected.

If you cannot provide a Git repository, please send the code as a ZIP file.

Include the following documentation:

* `/docs/engineering-notes.md`
* `/docs/pull-request.md`

---

## Global Requirements

These apply to all levels:

* Laravel 11 or 12
* PHP 8.3+
* PSR-12 code style
* Controllers must be thin. Business logic must not depend on HTTP classes.
* No direct use of `Request` inside domain or application classes.
* All destructive actions must be authorised via Policies.
* Code must be structured for long-term maintainability, not just task completion.

---

## Level 1: Foundations

### Goals

* Implement authentication
* Implement core User management
* Apply authorisation and basic security controls

### Prerequisites

Create the `users` table using the following legacy schema:

| Field              | Type             | Notes |
|--------------------|------------------|--------|
| id                 | bigint unsigned  | PK |
| prefixname         | varchar(255)     | Mr, Mrs, Ms |
| firstname          | varchar(255)     | required |
| middlename         | varchar(255)     | nullable |
| lastname           | varchar(255)     | required |
| suffixname         | varchar(255)     | nullable |
| username           | varchar(255)     | unique |
| email              | varchar(255)     | unique |
| password           | varchar(255)     | hashed |
| photo              | text              | nullable |
| type               | varchar(255)     | e.g. admin, user |
| remember_token     | varchar(100)      | |
| email_verified_at  | timestamp         | nullable |
| created_at         | timestamp         | nullable |
| updated_at         | timestamp         | nullable |
| deleted_at         | timestamp         | nullable |

### Required Endpoints

Implement only the following:

* index
* show
* store
* update
* destroy (soft delete)

### Authorisation

Implement a `UserPolicy`:

* Only admins may delete users.
* Users may view and update themselves.

### Model Accessors

Implement:

* `avatar`
* `fullname`
* `middleinitial`

---

## Level 2: Application Architecture & Testing

This level evaluates how you design a maintainable Laravel application.

### Goals

* Introduce a clean application layer
* Enforce validation boundaries
* Demonstrate a coherent testing strategy

### Architecture Requirements

Implement the following application actions:

* `CreateUser`
* `UpdateUser`
* `DeleteUser`

Each action must:

* Be HTTP-agnostic
* Accept typed input (DTO or array)
* Contain orchestration logic only
* Rely on Eloquent models or repositories beneath them

Controllers must delegate to actions and contain no business logic.

### Validation

* Use FormRequest classes for HTTP validation.
* Domain rules must not live in controllers.
* Justify your boundary choice in `engineering-notes.md`.

### Required Tests

Minimum coverage:

| Test Type | Coverage |
|----------|------------|
| Unit     | CreateUser |
| Unit     | UpdateUser |
| Feature  | Full happy-path user flow |
| Unit     | One model accessor |

Test quality is weighted more than raw quantity.

---

## Level 3: Events & Reliability

This level evaluates production-grade system thinking.

### Details Table

A migration for the `details` table is provided.

You must implement:

* `Detail` model
* User → Details relationship

Schema summary:

| Field   | Type |
|---------|-------|
| id      | bigint unsigned |
| key     | varchar(255) |
| value   | text |
| type    | varchar(255) |
| user_id | bigint unsigned |

Unique constraint on `(user_id, key)` is already defined.

---

### Event

Create a `UserSaved` domain event fired on user creation and update.

### Listener

Create `SyncUserProfileDetails` listener that persists:

| Key            | Value Source |
|----------------|----------------|
| Full name      | fullname accessor |
| Middle Initial | middleinitial accessor |
| Avatar         | avatar accessor |
| Gender         | Derived from prefixname |

### Reliability Requirements

* Listener must be idempotent.
* Duplicate records must not be created.
* Use upsert or equivalent strategy.

Document:

* Why this listener is synchronous or queued.
* What you would change under production load.

---

## Required Documentation

### `/docs/engineering-notes.md`

Max two pages covering:

* Architecture and layering decisions
* Validation strategy
* Key technical trade-offs
* Security considerations
* Testing philosophy
* What you would change in a long-lived system

### `/docs/pull-request.md`

Short PR-style summary:

* What was built
* Why major decisions were made
* How it was tested
* Known limitations

---

## Bonus Points

| Item | Points |
|------|--------|
| Audit log for destructive actions | 5 |
| Rate limiting on user creation | 5 |
| CI pipeline for tests and static analysis | 5 |
| Additional high-quality tests | 5 |

---

Good luck. This test is designed to reflect real lead-level engineering under realistic time constraints.
