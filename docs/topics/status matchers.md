# Status matchers

A status matcher matches a status returned by a procedure from the business logic. A status matcher has the responsibility to return a HTTP response. The status that is matched is an integer and has a meaning decided by the business logic. Example meanings might be:

- Successfully added a todo
- A todo with given description already exists

The status matcher possibly receives some data from the procedure it can use to create the HTTP response.



Status matchers are located inside the `/client/statuses` directory and are automatically included inside your application. You can name your status files any way you like and nest them in as many directories as you like as long as you place them inside the `/client/statuses` directory and give the filenames the `.php` suffix. 

## Examples

```php
status::matching ( 1000, function ( array $goals )
{
    // return http response
} );
```

> Example 1

In example 1 we match the status 1000 and receive an array of goals from the procedure.

### Matching multiple statuses

Sometimes we need data from multiple procedures. In this case we need to match multiple statuses as shown in the following example:

```php
status::matching ( [ 1009, 7009 ], function ( goal $goal, int $protein )
{
	// return http response
} );
```

> Example 2

In example 2 we match the status 1009 and 7009 coming from 2 different procedures. This status only runs when both status codes gets matched.

### Recommendations

A recommended way of naming status files is: `status number  meaning.php` for example:

- 1000 Found goals.php
- 1001 Added a goal.php
- 1002 Updated a goal.php
- 2000 A goal with given description already exists.php



Another recommendation is to split status code up in different ranges for different categories inside your application and group them in directories like so:

[directory] 1000 - 2999 goals

​		Using 1000 to 1999 for successful goal statuses

​		Using 2000 to 2999 for failure goal statuses 

[directory] 3000 - 4999 tasks

​		Using 3000 to 3999 for successful task statuses

​		Using 4000 to 4999 for failure task statuses