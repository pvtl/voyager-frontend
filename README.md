# Voyager Front-end

The Missing Front-end for The Missing Laravel Admin.

---

## Installation

#### 1. Copy this repos files to `/packages/pivotal/voyagerfrontend`

#### 2. Add the service provider to the `config/app.php` file in the providers array:

```php
'providers' => [
    // Laravel Framework Service Providers...
    //...

    // Package Service Providers
    // ...
    Pivotal\VoyagerFrontend\VoyagerFrontendServiceProvider::class,
    // ...

    // Application Service Providers
    // ...
],
```

#### 3. Add `"Pivotal\\VoyagerFrontend\\": "packages/pivotal/voyagerfrontend/src"` to the autoloader in `composer.json`

```json
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Pivotal\\VoyagerFrontend\\": "packages/pivotal/voyagerfrontend/src"
```


#### 4. Run the package installer

```bash
composer dump-autoload && php artisan voyagerfrontend:install
```

---

## Theme Development

From the root directory, install the front-end depenedencies `npm install`

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