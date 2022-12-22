## Simple REST application for work planning service.

### Business requirements:

- A worker has shifts
- A shift is 8 hours long
- A worker never has two shifts on the same day
- It is a 24 hour timetable 0-8, 8-16, 16-24

### Getting Started.

- Pull project.
- Run composer install to install all dependencies.

### Go to inc folder.

- copy the config.php.example into config.php file and enter your environment credential.

- Execute the sql scipt in table.sql to create the table.

### API

To create a new shift make a POST request to the URL
URL = "https://yoururl.com/new_shift"

Fields
{
"user_id" : 15,
"start" : "2022-12-08 00:00:00",
"end" : "2022-12-08 8:00:00"
}
