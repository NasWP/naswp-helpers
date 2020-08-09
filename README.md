# NasWP Helpers

*Bude doplněno.*

Funkcionalita je stejná jako u [naswp-kit-atomic](https://github.com/NasWP/naswp-kit-atomic) s rozdílem:

* neobsahuje žádné funkce specificky pro šablonu Atomic Block
* všechny hodnoty mohou být načteny z config souboru, ale hodnota předaná ve funkci má prioritu.

## TODO

[ ] Přenést Localization helper, co budou povinné parametry a tam být nemusí? Za předpokladu, že ne všechny šablony mají třeba sidebary/widgety.
[ ] Path v Lightbox helperu
[ ] Jak vyřešit to SVG & NPM knihovnu? https://github.com/NasWP/naswp-kit-atomic/pulls

## Použití

1. Načtěte soubor `class-naswp-helpers.php` ve `functions.php` z adresáře, kde máte helpery uložené.
1. Vytvořte třídu helperů, kde si budete aktivovat jednotlivé funkce. Parametr s odkazem na configurační json je nepovinný.

```php
require_once "inc/naswp-helpers/class-naswp-helpers.php";
$helpers = new NasWP_Helpers(__DIR__ . '/naswp-helpers.json');
```
