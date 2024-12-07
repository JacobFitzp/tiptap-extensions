## TipTap Extensions

![GitHub Pint Action Status](https://img.shields.io/github/actions/workflow/status/jacobfitzp/tiptap-extensions/pint.yml?branch=main&label=pint&style=flat-square)
![GitHub Larastan Action Status](https://img.shields.io/github/actions/workflow/status/jacobfitzp/tiptap-extensions/larastan.yml?branch=main&label=larastan&style=flat-square)
![GitHub Pest Action Status](https://img.shields.io/github/actions/workflow/status/jacobfitzp/tiptap-extensions/pest.yml?branch=main&label=pest&style=flat-square)
![GitHub Prettier Action Status](https://img.shields.io/github/actions/workflow/status/jacobfitzp/tiptap-extensions/prettier.yml?branch=main&label=prettier&style=flat-square)

## Prerequisites

### Sail

The app uses [sail](https://laravel.com/docs/11.x/sail) to run in a dockerized environment, you need to have [Docker](https://www.docker.com/) installed and running on your machine.

### GitHub

To login locally you need to have created an OAuth app in GitHub developer settings with the following:

<table>
    <tr>
        <th>Application name</th>
        <td>TipTap Extensions (dev)</td>
    </tr>
    <tr>
        <th>Homepage URL</th>
        <td>http://localhost</td>
    </tr>
    <tr>
        <th>Authorization callback UR</th>
        <td>http://localhost/auth/callback</td>
    </tr>
</table>

You should be given a client ID and secret which needs to be set in your .env:

```dotenv
GITHUB_CLIENT_ID=yourClientId
GITHUB_CLIENT_SECRET=yourClientSecret
```

## Setup

In this example `sail` is an alias of `./vendor/bin/sail`

```shell
# Copy the example environment file
cp .env.example .env

# Install dependencies
composer install
npm i

# Bring up the docker containers
sail up

# Setup application
sail art key:generate
sail art migrate

# Build assets for development
# Also watches for changes with hot reload
npm run dev
```

### Adding a moderator

To assign the moderator role to a user locally you first need to sign in with the account you want to use, you can the run the following command:

```shell
sail art user:moderator text@example.com
```

Making sure to use the email address associated with your account.


## Contribution

### Commands

There are a few composer commands you can use to make life easier:

`composer test` - Runs Pest test suite.

`composer analyse` - Runs Larastan / PHPStan analysis

`composer fix` - Runs Pint and Prettier

You should run all 3 of these commands before commiting any changes.
