<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class MarketplacePageController extends Controller
{
    public function home(): Response
    {
        return Inertia::render('Marketplace/Home', [
            'contactEmail' => config('marketplace.public_contact_email'),
        ]);
    }

    public function privacy(): Response
    {
        return Inertia::render('Marketplace/PrivacyPolicy', [
            'contactEmail' => config('marketplace.public_contact_email'),
        ]);
    }

    public function terms(): Response
    {
        return Inertia::render('Marketplace/Terms', [
            'contactEmail' => config('marketplace.public_contact_email'),
        ]);
    }

    public function publisherTerms(): Response
    {
        return Inertia::render('Marketplace/PublisherTerms', [
            'contactEmail' => config('marketplace.public_contact_email'),
        ]);
    }

    public function contact(): Response
    {
        return Inertia::render('Marketplace/Contact', [
            'contactEmail' => config('marketplace.public_contact_email'),
        ]);
    }
}
