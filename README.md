# JP Toolkit for WordPress

## Installing

#### Manual

Recommended in most cases.

1. Download the [jp-toolkit.zip](https://github.com/jprieton/jp-toolkit/releases/latest) file from GitHub
2. In your WordPress admin click *Plugin > Add New > Upload Plugin*.
3. Upload the ZIP file.
4. Activate the plugin.

#### Via Composer

This plugin is also available as [Composer package](https://packagist.org/packages/jp-toolkit/jp-toolkit) and can be installed via Composer from the root of your theme or plugin. Recommended when you want to bundle in your theme or plugin.

```bash
composer require jp-toolkit/jp-toolkit
```

**Note:**

When is installed via Composer it is necessary to initialize the **shortcodes** and **shorthands** handlers, this code can be placed in your `functions.php` of your theme or the root file of your plugin.

```php
// functions.php
new JPToolkit\Init();
```

 This code is **only** required when is installed via Composer, if you do not want use these handlers you can skip this step.

<br>

## Bug tracker?

Have a bug? Please create an issue on GitHub at https://github.com/jprieton/jp-toolkit/issues