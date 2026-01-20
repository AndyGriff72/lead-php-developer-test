# Requirements
- [x] Create /docs/engineering-notes.md and /docs/pull-request.md
- [x] Create migration for users table
- [ ] Install authentication
- [x] Create Users controller
- [ ] Create API routes
- [x] Create UserPolicy
- [ ] Implement model accessors
- [ ] Implement CreateUser, UpdateUser and DeleteUser application actions.
- [ ] Create unit tests
- [ ] Create audit log for destructive actions
- [ ] Impose rate limiting on user creation
- [ ] Create CI pipeline for tests and static analysis

## Routing
At present, the endpoints are all at the top level, so are not specific to the users table. In order to support additional operations on other tables/entities, these should be reimplemented as "/users/index", "/users/show", etc.

## HTTP methods
I have used PATCH instead of PUT for the "/update" endpoint, though the latter could theoretically be used.
