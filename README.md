# naswp-helpers

*Bude doplněno.*

Funkcionalita je stejná jako u [naswp-kit-atomic](https://github.com/NasWP/naswp-kit-atomic) s rozdílem:

* neobsahuje žádné funkce specificky pro šablonu Atomic Block
* všechny hodnoty mohou být načteny z config souboru, ale hodnota předaná ve funkci má prioritu.

## TODO

[ ] Přenést Localization helper, co budou povinné parametry a tam být nemusí? Za předpokladu, že ne všechny šablony mají třeba sidebary/widgety.

[ ] Path v Lightbox helperu

[ ] Jak vyřešit to SVG & NPM knihovnu? https://github.com/NasWP/naswp-kit-atomic/pull/3

## Použití

1. Načtěte soubor `class-naswp-helpers.php` ve `functions.php` z adresáře, kde máte helpery uložené.
1. Vytvořte třídu helperů, kde si budete aktivovat jednotlivé funkce. Parametr s odkazem na configurační json je nepovinný.

```php
require_once "inc/naswp-helpers/class-naswp-helpers.php";
$helpers = new NasWP_Helpers(__DIR__ . '/naswp-helpers.json');
```

Zbytek stejně jako ve [WordPress Kitu](https://github.com/NasWP/naswp-kit-atomic) s tím rozdílem, že všechny parametry mohou být načítány rovnou z konfiguračního souboru:

```json
{
  "sitemap": [
    "page"
  ],
  "mimes": {
    "svg": "image/svg+xml"
  },
  "ga": "UA-00000000",
  "gtm": "GTM-00000000",
  "colors": {
    "Light": "#EAF7FF",
    "Blue Light": "#96D8FF",
    "Blue Dark": "#0459AA",
    "Dark": "#002140",
    "Blue Bright": "#00B7FF"
  },
  "allow_custom_colors": true,
  "gradients": {
    "Light": "linear-gradient(90deg, rgba(0,183,255,1) 0%, rgba(4,89,170,1) 100%)",
    "Dark": "linear-gradient(90deg, rgba(4,89,170,1) 0%, rgba(0,33,64,1) 100%)"
  },
  "allow_custom_gradients": true
}
```

*TODO* asi přemístit sem?
