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
cp .env.example .env

sail up

sail art key:generate
sail art migrate
```
