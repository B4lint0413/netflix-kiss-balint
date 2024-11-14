# Laravel alap 2024

## Előkészületek

A backend egy Laravel 11-es keretrendszert tartalmaz, a fejlesztésehez szükséges docker környezettel integrálva.


1. Környezeti változók beállítása:

    A Docker és a Laravel is a környezeti változókat használja a konfigurációhoz.
    Ezeket az adatok a `.env` fájlban célszerű eltárolni.
    Mivel az egyes példányok esetében eltérőek lehetnek, így a repository-ban nem lett eltárolva a fájl.

    A `backend` tartalmaz egy `.env.example`, ami tartalmazza az általános beállításokat. Ebből kell egy másolatot létrehozni `.env` néven.

    ```bash
    cp .env.example .env
    ```

    Az alábbi változók értékeit célszerű megvizsgálni, hogy megfeleljen az aktuális projektnek és ne ütközzön más portokkal.

    - `WEB_HOST`:  A backend elérésének a címe
    - `WEB_PORT`:  A backend portja
    - `PMA_PORT`:  A phpMyAdmin eléhetőségének a portja
    - `DB_NAME`: Az adatbázis neve.

2. docker build

    A php-hoz tartozó image-t a `Dockerfile` recept alapján elsőre fel kell építani. Ez a lépés az első indításkor fontos, ha nem találja meg a gépen, akkor megteszi magától is a konténer indításakor. Ugyanakkor ha a fájl tartalma megváltozik, akkor nem fut le újra a build, hanem a korábban lebuildelt image-t használja.

    ```bash
    docker compose build
    ```

3. docker compose up

    ```bash
    docker compose up -d
    ```

    - A `-d` hatására detached módban indul, azaz a konténerek kimenete leválasztásra kerül a konzolról, így az továbbra is használható marad.

4.  composer

    A `composer.lock` tartalmazza, hogy mik azok a tényleges, konkrét csomagok, amik szükségesek egy laravel projekthez.
    Első futtatáskor még nem létezik a `vendor` mappa, hiszen szerepel a `.gitignore` fájlban. Ezért első futtatáskor, vagy
    a `composer.lock` változása esetén (mert pl. új csomag került be a`composer.json` fájlba) szükséges a `composer install` futtatása a konténeren belül. A **docker compose** és a **composer** nem összekeverndő!

    ```bash
    docker compose exec backend composer install
    ```

5. migráció
    
    A laravel bizonyos adatokat adatbázisbantárol el, ennek a létrehozása a migrációs fájlok futtatásával lehetséges.

    ```bash
    docker compose exec backend artisan migrate
    ```

5. api key

    A laravelnek szüksége van minden projekthez egy egyedi kulcsra. Amennyiben ez nem található meg a `.env` fájlban, úgy le kell generálni. **Ez csak első futtatáskor szükséges, ha még nem lett beállítva az APP_KEY**

    ```bash
    docker compose exec backend php artisan key:generate
    ```