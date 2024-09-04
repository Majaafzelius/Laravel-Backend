# Projekt webbtjanst-api
Detta Laravel-projekt utgör backenden för applikationen. 
Det är byggt med Laravel, ett kraftfullt PHP-ramverk som erbjuder en robust och skalbar struktur 
för att skapa API:er och hantera databasinteraktioner.

## Funktioner
- <b>API:</b> <br>
Projektet erbjuder en fullständig API-lösning för att stödja frontend-funktionaliteten.<br>
Använd Laravel Resource Controllers för att enkelt strukturera API-endpoints.
- <b>Databasinteraktion: </b> <br>
Eloquent ORM används för att förenkla och abstrahera databasinteraktioner.<br>
Migrationsfiler definierar tydligt databastabellerna och deras relationer.<br>

## Installation
1. Klona projektet till din lokala maskin.
2. Kör composer install för att installera alla PHP-paket och dependencies.
3. Kopiera filen .env.example till .env och ange din databasinloggning och andra inställningar.
5. Kör php artisan migrate för att köra databasmigreringar.
6. Kör php artisan serve för att starta Laravel-utvecklingsservern.

## Tekniker och Ramverk
- Laravel 8
- Eloquent ORM
- Laravel Sanctum för autentisering
