# Requirements
- [x] Create /docs/engineering-notes.md and /docs/pull-request.md
- [x] Create migration for users table
- [x] Install authentication (Laravel Sanctum)
- [x] Create Users controller
- [x] Create API routes
- [x] Create UserPolicy
- [ ] Implement model accessors
- [ ] Implement CreateUser, UpdateUser and DeleteUser application actions.
- [ ] Create unit tests
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
