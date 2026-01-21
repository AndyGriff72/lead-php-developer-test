# PR Summary

## What was built

* Implemented a fully-functional REST API for user entities, complete with `index`, `store`, `show`, `update` and `delete` endpoints.
* Created a UserSaved event and corresponding SyncUserProfileDetails listener to synchronize data between the `users` and `details` tables. This sync process is idempotent due to using `updateOrCreate` to persist details data.
* Added rate limiting of 60 requests per minute to all endpoints.
* Integrated PSR-12 code formatting.
* Created a GitHub Actions job to run code formatter and unit tests on push action.
* Added unit and feature tests to cover happy path and some exception scenarios.

## Why major decisions were made

### Typed detail storage
This supports a hierarchy of user attributes, based on the assumption that `type` is a level of hierarchy above `key`.

### Use of useOrCreate for details data
This, in combination with the unique key defined on the table and the consistency of keys within the listener functions, allows for idempotency.

## How it was tested

### Unit tests
Unit tests were created for model accessors, `CreateUser` and `UpdateUser` actions and the `deriveGender` method on the `SyncUserProfileDetails` listener.

### Feature tests
Feature tests were created for the full happy-path flow and the `SyncUserProfileDetails` feature test to verify that all required `details` records exist in the database after the handler was run.

### Manual tests
The endpoints were all tested in Postman. These are available in the `tests/Postman` folder and can be imported into your own Postman workspace.

## Known limitations

* No pagination of results in `/users/index` endpoint.
* The `deriveGender` logic is simple and based only on the "title" prefix. This can't handle certain titles, e.g. "Dr" or "Rev".
* The same rate limiting parameters are applied across all endpoints.
