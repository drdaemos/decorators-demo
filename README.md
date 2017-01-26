# Forwarding decorators

This is the demo of the concept described in Sitepoint article - Achieving modular architecture with Forwarding Decorators.

This demo showcases the typical PHP app with the modular architecture. Modules can added and removed, and their files can modify core files on-the-fly. Decorator compiler (located inside `Includes` directory) is the stripped version of the X-Cart 5 decorator (Copyright © 2001-present Qualiteam software Ltd).

## Installation and configuration

```bash
composer install
php rebuild.php
```

Some configuration can be made through modifying bootstrap.php:

- `LC_DEVELOPER_MODE` switches between development and production autoloader (true by default). Development autoloader tracks changes inside `classes` folder but not module installation.

## Running the app

```bash
php app.php
```

## What does it do?

The app runs some simple code which by default should output the example message:

```
Foo modified by Module1
```

App-specific code is located inside `classes/DecoratorsDemo` folder. Take a look at `classes/DecoratorsDemo/Example/Foo.php` class and `classes/DecoratorsDemo/Module/Module1/Example/Foo.php` class decorator.

## Managing modules of the system

You can modify `.decorator.modules.ini` to add\enable\disable modules. Each module takes a line inside `[modules_list]` section. Key is the module folder and the value is the enabled state (1 for enabled and 0 for disabled).

Module code should be placed inside `classes/DecoratorsDemo/Module/` folder in a separate folder. `Module1` is the example module, but you can add more. Each module is required to have `Definition.php` file inside its folder.

If you've added the new module, run `php rebuild.php` to compile the classes. Changes to the already installed module should be applied on-the-fly, no rebuild needed.

## Modifying the classes (decorating)

To modify some class, you should extend it with another class inside module folder and add the marker interface - `\Includes\DecoratorInterface`. If several decorators are applied, you can control the order via this class annotations:

- `Decorator\Before("ModuleName")` -- puts decorator before some module decorator (ignored if the other module is not installed).
- `Decorator\After("ModuleName")` -- puts decorator after some module decorator (ignored if the other module is not installed).
- `Decorator\Rely("ModuleName")` -- enables this decorator only if some module is installed or not installed, if you specify module name as !ModuleName.
- `Decorator\Depend("ModuleName")` -- combines `Rely` and `After`.

----------------------

Thanks for checking this out.

– Eugene Dementjev, @drdaemos, X-Cart core developer
