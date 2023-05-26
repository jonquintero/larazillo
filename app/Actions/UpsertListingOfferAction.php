<?php

namespace App\Actions;

use App\DataTransferObjects\ListingData;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpsertListingOfferAction
{
    public function execute(Model $listing, Request $request): void
    {
        $offer = $listing->offers()->save(
            Offer::make(
                $request->all()
            )->bidder()->associate($request->user())
        );

        $listing->owner->notify(
            new OfferMade($offer)
        );
    }
}
