# Voyager Frontend

![Voyager Frontend Screenshot](/readme-intro.jpg)

__The Missing Frontend for The Missing Laravel Admin.__

This [Laravel](https://laravel.com/) package adds frontend views, routes and assets to a [Voyager](https://laravelvoyager.com/) project.

It comes with a basic structure for frontend layouts (eg. header, footer, etc) and theme assets using the [Foundation](https://foundation.zurb.com) framework.

Built by [Pivotal Agency](https://pivotal.agency/).

---

## Prerequisites

- Node & NPM Installed
- Composer Installed
- [Install Laravel](https://laravel.com/docs/installation)
- [Install Voyager](https://github.com/the-control-group/voyager)

---

## Installation

```bash
# 1. Require this Package in your fresh Laravel/Voyager project
composer require pvtl/voyager-frontend

# 2. Run the Installer
composer dump-autoload && php artisan voyager-frontend:install

# 3. Build the front-end theme assets
npm run dev
```

_Any issues? See [the troubleshooting section](#toubleshooting) below._

### 'Got Cron'?

This is a just a reminder to setup the standard Laravel cron on your server. The Voyager Frontend package has a few scheduled tasks, so relies on the cron running.

```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

---

## Theme Development

#### SCSS & JS

When you're ready to start styling your frontend, you can use the following commands after making updates to SCSS and/or JS files:

| Command | Description |
| --- | --- |
| `npm run watch` | Watches your `/resources/assets` for any changes and builds immediately |
| `npm run dev` | Builds SCSS/JS on demand |
| `npm run prod` | Builds SCSS/JS on demand, but this time, outputs minified results |

#### Overriding Views

Let's say you want to update the layout of the frontend header:

1. Create the directory `resources/views/vendor/voyager-frontend`
    - Any files you place in here will replace the default views that comes with this package
1. Copy the respective file from `vendor/pvtl/voyager-frontend/resources/views/` (in this case, the `partials/header.blade.php`) into the matching file structure and update

So now you'll have:

```
    /resources
        /views
            /vendor
                /voyager-frontend
                    /partials
                        /header.blade.php
```

And any changes made to `header.blade.php` reflect automatically on the site.

---

## Thumbnails / Image Resizing

This package comes with an automatic image resize function. When you reference an image in your front-end blade templates, simply call something like:

```html
{{ imageUrl($pathToImage, $width, $height, $config = ['crop' => false, 'quality' => 100] ) ?: '/default.png' }}

<!-- For example (where $blockData->image = 'blocks/3hkkskd8.jpg'): -->
<img src="{{ imageUrl($blockData->image, 300) ?: '/default.png' }}" />
```

### "CDN" your images

The function will output an absolute URL, where the hostname will be `APP_URL` - however you can add a `ASSET_URL` variable to your `.env` file to use a different hostname.

---

## Search

#### Generating Indices
This module contains a scheduled job to regenerate indices which will run automatically once you setup jobs for Laravel. If you need to test and re-generate search indices you can manually run the command `php artisan voyager-frontend:generate-search-indices`.

#### Configuring Search (Using Laravel Scout)
By default this module includes "searching" the "Pages" and "Posts" Models out-of-the-box once you have defined the following variable in your `.env` file - [check out the Laravel Scout documentation](https://laravel.com/docs/5.5/scout):

```
SCOUT_DRIVER=tntsearch
```
 
 You can however extend and define your own "Searchable" Models to include in your search results by attaching the "Searchable" trait to them.

```php
class Page extends Model
{
    use Searchable;

    public $asYouType = false;

    /**
     * Get the indexed data array for the model.
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // customise the searchable array
        
        return $array
    }
}
```

Then you'll be able to hook into the search config and _merge_ your "Searchable" Models in with the config key (preferably using a Servie Provider): `scout.tntsearch.searchableModels`.
```php
$this->mergeConfigFrom(self::PACKAGE_DIR . 'path/to/config/scout.php', 'scout.tntsearch.searchableModels');
```

Your configuration file should contain values similar to this modules scout.php configuration:
```php
<?php

return [
    '\My\Searchable\Models\Namespace',
];
```

## Testing

You can test the Pvtl/Test package switching to the packages directory and running tests via composer scripts:

```
  cd packages/pivotal/test;
  composer run test
```

---

## Toubleshooting

#### Error: `Class VoyagerFrontendDatabaseSeeder does not exist`

Simply run `php artisan voyager-frontend:install` again

#### Error: `The command "npm i ..." failed.`

Run `npm install` and then try `php artisan voyager-frontend:install` again
