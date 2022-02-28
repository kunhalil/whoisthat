# About WhoIsThat

This is demo app for Contact Manager API.

Uses [Laravel Sanctum](https://github.com/laravel/sanctum) for authentication.

## Prerequisites

There is no live demo for this app and it is necessary to setup locally to explore the APIs.

Make sure that you have a PHP ecosystem ready for testing and you have;
- installed **composer**
- installed and configured database with access credentials to add to `.env` file

## Installation Steps
1. Clone the project ( git@github.com:kunhalil/whoisthat.git )
2. Navigate to the project root directory
3. Run `composer install`
4. Copy `.env.example` into `.env` file
5. Adjust `DB_*` parameters as required
6. Run `php artisan key:generate`
7. Run `php artisan migrate`
8. Run `php artisan db:seed` to populate the database with test data
9. Run `php artisan serve` to start the local development server

## Testing
It is necessary to be a registered user and issue user token to make API calls.

During migration a demo user is already created with the credentials;
- login id: `joeblogs@example.com`
- password: `password`

Alternatively you can register as a new user and create a Token.

#### Postman Collection file for Testing
A postman collection file is included for testing.

Download the collection file [postman_collection.json](postman_collection.json) and import into postman.

Postman global variables arre used as follows;
- BASE_URL: Set this to your local development root url.
- TOKEN: Token must be issued for the current user and added for testing.
- COMPANY_ID: The record id to be passed for identifying `company` record
- CONTACT_ID: The record to be passed for identifying `contact` record
- CONTACT_NAME_SEARCH_STR: `Contact first or last name` search string to find matching contacts
- COMPANY_NAME_SEARCH_STR: `Company name` search string to find matching contacts

#### End points

Following are end points available for testing;

1. Get all company details
- Url: {{BASE_URL}}/api/v1/companies
- Action: GET

2. Get paginated contacts
- Url: {{BASE_URL}}/api/v1/contacts/collection?page=
- Action: GET
- Parameter: page number (defaults to 1)

3. Create a contact
- Url: {{BASE_URL}}/api/v1/contacts
- Action: POST
- Parameter: Contact input object

4. Get a single contact
- Url: {{BASE_URL}}/api/v1/contacts/:ID
- Action: GET
- Parameter: Contact id

5. Edit a contact
- Url: {{BASE_URL}}/api/v1/contacts/:ID
- Action: PUT
- Parameter: Contact id and Contact input object

6. List all contacts for a company
- Url: {{BASE_URL}}/api/v1/companies/:ID/contacts
- Action: GET
- Parameter: Company id

7. Find contact by name
- Url: {{BASE_URL}}/api/v1/contacts?name={{CONTACT_NAME_SEARCH_STR}}
- Action: GET
- Parameter: Contact name search string

8. Find contact by Company name
- Url: {{BASE_URL}}/api/v1/contacts?company={{COMPANY_NAME_SEARCH_STR}}
- Action: GET
- Parameter: Company name search string

9. Create notes for a contact
- Url: {{BASE_URL}}/api/v1/contacts/:ID/note
- Action: POST
- Parameter: Contact ID and Contact note object

10. Create contacts (multiple) for the same company
- Url: {{BASE_URL}}/api/v1/companies/:ID/contacts
- Action: PUT
- Parameter: Company Id and Array of contact objects

## Unit Testing

Run `php artisan test` to run the application tests

## Contributing
...

## Code of Conduct
...

## Security Vulnerabilities
...

## License

The [MIT license](https://opensource.org/licenses/MIT).
