## Michelle Rather
### Overall, the total time was abour 4.5hrs from setup to finish
### A list of general steps you took from start to finish

- Ran composer create-project --prefer-dist laravel/laravel react-laravel-simple-messaging
- Fixed this error :   Your github oauth token for github.com contains invalid characters:  in auth.json
- composer require laravel/ui
- php artisan make:controller UserController
- php artisan make:controller MessageController
- php artisan make:migration create_user_messages_table
- Altered the create_users_table migration to use first name, last name, and removed name. Were this migration already executed. Alternatively, I would create another migration titled add_first_and_last_names_to_users_table and update and do the following:
- Create two new string columns first_name, last_name in the up() function
- Drop the name column in the down() function
- Update the UserFactory to also use first_name and last_name
- Created a user_messages_table
- Created factories for db seeding samples
- Created database seeds
- Created User and Message controllers
- Created User and Message models
- Altered Login and Register controllers
- Added Routes