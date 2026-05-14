# Local Laravel Herd Setup

Use this after unzipping the project.

## 1. Move project into Herd parked folder

Example:

```bash
cd ~/Herd
unzip ~/Downloads/dataflair-marketplace-laravel-app.zip
cd dataflair-marketplace-laravel-app
```

## 2. Install PHP dependencies

```bash
composer install
```

## 3. Install frontend dependencies

```bash
npm install
```

## 4. Create environment file

```bash
cp .env.example .env
php artisan key:generate
```

## 5. Create SQLite database and migrate

```bash
touch database/database.sqlite
php artisan migrate
```

No seed is required.

If you want to run seed anyway:

```bash
php artisan db:seed
```

The seeder is empty by design.

## 6. Run Vite

```bash
npm run dev
```

Do not run `php artisan serve` with Herd.

Open:

```txt
http://dataflair-marketplace-laravel-app.test
```

If you renamed the folder to `marketplace-dataflair`, open:

```txt
http://marketplace-dataflair.test
```

## 7. Test form email locally (Mailpit)

`.env.example` targets [Mailpit](https://github.com/axllent/mailpit) over SMTP (`127.0.0.1:1025`). Start Mailpit, then open its web UI (default `http://127.0.0.1:8025`).

Submit the waitlist or contact form. You should see:

1. Internal notification email
2. Confirmation email to the submitter

If you are not running Mailpit, set `MAIL_MAILER=log` in `.env` and tail the log instead:

```bash
tail -f storage/logs/laravel.log
```

## 8. Test database record

```bash
php artisan tinker
```

Then:

```php
App\Models\MarketplaceLead::latest()->first();
```

## 9. Run tests

```bash
php artisan test
```
