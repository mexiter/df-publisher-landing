# DataFlair Publisher Marketplace — Full Laravel App

This is a complete runnable Laravel 13 + Vue 3 + Inertia v3 landing page app for local Laravel Herd development and later Forge deployment.

It includes:

- `artisan`
- `composer.json`
- `package.json`
- Laravel routes/controllers/requests/models/migrations
- Vue 3 + Inertia pages
- Waitlist form
- Contact form
- Confirmation modal after submission
- Confirmation email to the submitter
- Internal email to two configured recipients
- Privacy Policy, Terms, Publisher Terms, Contact page
- Resend configuration
- Herd local setup guide
- Forge deploy script
- Feature tests

## Local setup with Laravel Herd

Put this folder in your Herd parked directory, for example:

```bash
cd ~/Herd
unzip ~/Downloads/dataflair-marketplace-laravel-app.zip
cd dataflair-marketplace-laravel-app
```

Install dependencies:

```bash
composer install
npm install
```

Create `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

Create local SQLite database:

```bash
touch database/database.sqlite
php artisan migrate
```

Run Vite:

```bash
npm run dev
```

Open:

```txt
http://dataflair-marketplace-laravel-app.test
```

If you rename the folder to `marketplace-dataflair`, open:

```txt
http://marketplace-dataflair.test
```

## Local email testing (Mailpit)

`.env.example` is set up for [Mailpit](https://github.com/axllent/mailpit): a local SMTP sink with a web inbox.

1. Install and start Mailpit on your machine (Docker, Homebrew, or a binary — see the Mailpit docs).
2. Keep the default SMTP settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
```

3. Open the Mailpit UI (by default `http://127.0.0.1:8025`) and submit the waitlist or contact form. You should see the confirmation and internal notification messages there.

If you prefer not to run Mailpit, you can send mail to the log instead:

```env
MAIL_MAILER=log
```

Then watch `storage/logs/laravel.log`:

```bash
tail -f storage/logs/laravel.log
```

## Production email with Resend

On production, switch the mailer to Resend and set your API key:

```env
MAIL_MAILER=resend
RESEND_API_KEY=re_your_key_here
MAIL_FROM_ADDRESS=marketplace@dataflair.ai
MAIL_FROM_NAME="DataFlair Marketplace"
```

Use a sender address on a domain you have verified in Resend. Laravel 13 ships the Resend mail transport via the Resend PHP SDK in `composer.json`.

## Internal notification recipients

Set both emails here:

```env
MARKETPLACE_NOTIFY_EMAILS=merxhanemini@gmail.com,partner@example.com
```

Replace `partner@example.com` with your business partner's email.

## Production domain

For Forge:

```env
APP_URL=https://marketplace.dataflair.ai
```

Create a Forge site with domain:

```txt
marketplace.dataflair.ai
```

Web directory:

```txt
/public
```

## Legal note

The included Privacy Policy, Terms, and Publisher Terms are starter drafts and should be reviewed by counsel before publishing.
