<?php

namespace App\Http\Controllers;

use App\Actions\UpsertListingAction;
use App\DataTransferObjects\ListingData;
use App\Http\Requests\UpsertListingRequest;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;
use Inertia\Response;

class ListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(): Response
    {
        $filters = RequestFacade::only('priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo');

        return Inertia::render(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->withoutSold()
                    ->paginate(10)
                    ->withQueryString()
            ],
        );
    }

    public function show(Listing $listing): Response
    {
      //  abort_unless(Auth::check() && Auth::user()->can('view', $listing), 403);
        $listing->load(['images']);
        $offer = !Auth::user() ?
            null : $listing->offers()->byMe()->first();

        return Inertia::render(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer,
            ]
        );
    }



}
