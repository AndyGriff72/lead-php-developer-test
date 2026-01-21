# Requirements
- [x] Create /docs/engineering-notes.md and /docs/pull-request.md
- [x] Create migration for users table
- [x] Install authentication (Laravel Sanctum)
- [x] Create Users controller
- [x] Create API routes
- [x] Create UserPolicy
- [x] Implement model accessors
- [x] Implement CreateUser, UpdateUser and DeleteUser application actions.
- [x] Create unit tests
- [x] Create happy path feature test
- [ ] Create Detail model and details table
- [ ] Create UserSaved event
- [ ] Create SyncUserProfileDetails listener
- [ ] Create audit log for destructive actions
- [ ] Impose rate limiting on user creation
- [ ] Create CI pipeline for tests and static analysis

## Basic assumptions
Given that there is no mention of a front end in the README.md file, this project has been implemented as an API and its authentication system set up accordingly using Laravel Sanctum.

# Database seeding
In order to create a test admin and a regular user, I created a database seeder class called AdminUserSeeder, which creates these two users:

User type   Email               Password
--------------------------------------------
Admin       admin@example.com   Password1234
Regular     test@example.com    Password1234

# Authorization
Because all the resource authorization is being handled by the UserPolicy class, the requests (CreateUserRequest, UpdateUserRequest and DeleteUserRequest) all return "true" from their own authorize functions.

# Tests
Postman tests have been included in the repository in JSON format. These can be imported into Postman for testing and could also be used in a CI/CD deployment pipeline.

# Request data validation
I have created three different request classes for create, update and delete operations: CreateUserRequest, UpdateUserRequest and DeleteUserRequest as they all have specific validation requirements. In creation of the user, we have a lot of "required" fields which correspond to the non-nullable fields in the database without a default value. However, we don't want to validate all these fields when updating and should only do so if the field is present in the request.

# Improvements

## Pagination of records in /index
Instead of `User::all()`, it is possible to use `User::paginate(...)` and use either a preset page size or one that is retrieved from an environment variable.
