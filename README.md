# Voyager Frontend

__The Missing Frontend for The Missing Laravel Admin.__

This [Laravel](https://laravel.com/) package adds frontend views, routes and assets to a [Voyager](https://laravelvoyager.com/) project.

---

## Prerequisites

- [Install Laravel](https://laravel.com/docs/installation)
- [Install Voyager](https://github.com/the-control-group/voyager)

---

## Installation

#### 1. Require the Package

After creating your new Laravel/Voyager application, include the _Voyager Frontend_ package with the following command:

```
composer require pivotal/voyagerfrontend
```

#### 2. Run the Installer

```
composer dump-autoload && php artisan voyagerfrontend:install
```

#### 3. Build the front-end theme assets

```
npm install && npm run dev
```

_Any issues? See [the troubleshooting section](#Toubleshooting) below._

---

## Theme Development

When you're ready to start styling your frontend, you can use the following commands after making updates to SCSS and/or JS files:

| Command | Description |
| --- | --- |
| `npm run watch` | Watches your `/resources/assets` for any changes and builds immediately |
| `npm run dev` | Builds SCSS/JS on demand |
| `npm run prod` | Builds SCSS/JS on demand, but this time, outputs minified results |

---

## Testing

You can test the Pivotal/Test package switching to the packages directory and running tests via composer scripts:

```
  cd packages/pivotal/test;
  composer run test
```

---

## Toubleshooting

#### Error: `Class VoyagerFrontendDatabaseSeeder does not exist`

Simply run `php artisan voyagerfrontend:install` again

#### Error: `The command "npm i ..." failed.`

Run `npm install` and then try `php artisan voyagerfrontend:install` again
