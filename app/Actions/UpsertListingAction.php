<?php

namespace App\Actions;

use App\DataTransferObjects\ListingData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UpsertListingAction
{
    public function execute(ListingData $listingData, Model $listing): void
    {
        $listing->user_id = Auth::id();
        $listing->beds = $listingData->beds;
        $listing->baths = $listingData->baths;
        $listing->area = $listingData->area;
        $listing->city = $listingData->city;
        $listing->street = $listingData->street;
        $listing->street_nr = $listingData->street_nr;
        $listing->code = $listingData->code;
        $listing->price = $listingData->price;

        $listing->save();
    }
}
