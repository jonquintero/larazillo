<?php

namespace App\Http\Controllers;

use App\Actions\UpsertListingOfferAction;
use App\Http\Requests\UpsertListingOfferRequest;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function __construct(private readonly UpsertListingOfferAction $upsertListingOfferAction)
    {
    }

    public function store(Listing $listing, UpsertListingOfferRequest $request)
    {
        $this->authorize('view', $listing);

        $this->upsertListingOfferAction->execute($listing, $request);

        return redirect()->back()->with(
            'success',
            'Offer was made!'
        );
    }
}
