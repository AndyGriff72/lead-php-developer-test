# Engineering notes

## Architecture and layering decisions
The basic architecture -- the layered validation, the event-driven creation of `details` records, the general separation of concerns, etc. -- was laid out in the specifications in the README file. However, I have detailed below where I have made specific decisions outside the scope of that document.

### Service classes
I added the `ApiResponseFormatterService` class in order to ensure a consistent response structure across endpoints but which also supports further customization as required.

### Laravel Sanctum
For the purposes of this exercise, I used Laravel Sanctum as the requirements outlined in the README do not warrant the complexity of Passport.

### Listener design
The `SyncUserProfileDetails` listener is robust and idempotent by design. The use of `updateOrCreate` and the unique key defined on the `details` table ensure that no duplicate records are created and ensures idempotency.

### Code quality
A basic one, this, but an important one. The code uses descriptive variable names and sufficient code comments to ensure that future developers will be able to determine both _what_ a piece of code is doing and _why_ it's doing it.

For PSR-12 code formatting, I added Laravel Pint to the project and created a composer script entry; the linter can be run by calling "composer format".


## Validation strategy
I have created three different request classes for create, update and delete operations: CreateUserRequest, UpdateUserRequest and DeleteUserRequest as they all have specific validation requirements. In CreateUserRequest, we have a lot of "required" fields which correspond to the non-nullable fields in the database without a default value. However, we don't want to validate all these fields in UpdateUserRequest and should only do so if the field is present in the request.


## Key technical trade-offs

* The `deriveGender` function is intentionally simplistic as the spec did not require a more complex model.
* To maintain separation of concerns, the creation of `details` records is performed by the `UserSaved` event plus `SyncUserProfileDetails` listener, when it could theoretically have been done inside the controller.
* The `SyncUserProfileDetails` listener is synchronous, largely due to simplicity and because the work it does -- four small database writes -- is lightweight.


## Security considerations

* Laravel Sanctum was used to implement authentication and resource authorization is handled by the UserPolicy class.
* Throttling was set at 60 requests per minute on all endpoints.
* Incoming data is validated through the use of Laravel Form Requests, which stops malformed or malicious data.
* No sensitive data is exposed by the API endpoints, e.g. passwords or tokens.

### Known limitations

* Because all the resource authorization is being handled by the UserPolicy class, the requests (CreateUserRequest, UpdateUserRequest and DeleteUserRequest) all return "true" from their own authorize functions. For more nuanced authorization, these may need to be implemented.
* Rate limiting should be more granular, i.e. applied individually to endpoints.


## Testing philosophy

### Mock data
I have used the user factory to create test instances instead of using PHPUnit mocks. This allows for more integrated testing of the event listener processes, since using factories instead of mocks ensures that tests verify real model behaviour.

### Database seeding
In order to create a test admin and a regular user, I created a database seeder class called AdminUserSeeder, which creates these two users:

| User type | Email | Password |
|-----------|-------|----------|
| Admin | admin@example.com | Password1234
| Regular | test@example.com | Password1234

### Postman tests
Postman tests have been included in the repository in JSON format, which can be imported into Postman for testing. There is some overlap here with the PHPUnit feature tests but I find Postman useful for demonstration purposes as well as its ability to be integrated into a CI/CD deployment pipeline.


# What you would change in a long-lived system

* Structured logging and monitoring: this is vital to a production system and is invaluable for debugging and generally maintaining operational health.

* Pagination of records in `/index`: instead of `User::all()`, use `User::paginate(...)` and use either a preset page size or one that is retrieved from an environment variable.

* Better handling of gender attribute for `details` table. Should probably have its own column in the `users` table.

* Rate limiting should be made more granular in bootstrap/app.php. At present, all endpoints are rate-limited to 60 requests in one minute. This can be implemented separately for each endpoint.

* A front end. Obviously, if this were a real system, there would need to be a front end application through which users can access the API endpoints.

* I would advocate that the `SyncUserProfileDetails` listener be queued in a production system, especially if we were anticipating a large volume of requests or the handling of more complex data. Queueing would allow for automatic retries, dead-letter handling, etc. which would make a more robust system overall.

---

## Interpretations

### The `type` column in the `details` table
There is no explanation as to this column's purpose and there is already a `key` column, so I have assumed that this is another level up the hierarchy and may contain values like "profile", "metadata", etc. (It is possible that this was present in the migration file which is mentioned in the README file but not present in the blank repo.) This is definitely something I would clarify with the product owner/project manager before starting.

### The `value` column in the `details` table
I have set this to allow null values to allow compatibility with the `users` table `photo` column, which also allows null values. If this were not the desired behaviour, and the value field should not be nullable, I should amend the `avatar` accessor to return an empty string.
