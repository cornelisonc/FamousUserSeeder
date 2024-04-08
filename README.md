# FamousUserSeeder

Make your users famous!

```php
namespace Database\Seeders;

use Cornelisonc\FamousUserSeeder\NicCage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nicCage = new NicCage();

        Db::table('users')->insert(
            $nicCage->get(
                50,
                [
                    'fullName',
                    'email',
                    'password'
                ]
            )
        );
    }
}
```

## Installation

```composer require cornelisonc/famous-user-seeder```

## Famous User Classes
#### Available FamousUser classes:
* NicCage

#### Future FamousUser classes:
* ChristopherWalken
* JeffGoldblum
* SamuelLJackson
* SteveBuscemi
* BettyWhite
* BillMurray
* Simpsons
* TheOffice
* StarWars
* ...and more!

## Usage

FamousUser instances' `get()` functions accept two arguments: the number of users to generate (quantity) and an array of fields to include in the output.

The fields currently available are:

```php
$fields = array[
    'fullName',
    'firstName',
    'lastName',
    'email',
    'password'
];
```

If you would like to generate a field not listed here, pass it in to the `$fields` array and it will be generated as 10-character randomized alphanumeric string.

Fields can also be aliased, if you would like a field to be output as a different key in the array, pass in the desired key as the value in the `$fields` array:

```php
$nicCage->get(1, array(
    'name'              => 'fullName'
    'first'             => 'firstName',
    'last'              => 'lastName',
    'favorite_color'    => 'favorite_color'
));

// will return:

array([
    'name'              => 'Yuri Orlov',
    'first'             => 'Yuri',
    'last'              => 'Orlov',
    'favorite_color'    => '7d8fff9aq2' // 10 char random string
]);
```

Email addresses are formatted using the user's first & last name seperated by a period, with the domain name likeiwse a randomized string to provide unique email addresses.

![implementation example](https://github.com/cornelisonc/FamousUserSeeder/blob/main/png.jpg?raw=true)