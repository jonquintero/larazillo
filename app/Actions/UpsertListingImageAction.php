<?php

namespace App\Actions;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;

class UpsertListingImageAction
{
    public function execute(Request $request, Listing $listing): void
    {
        if ($request->hasFile('images')) {

            $images = collect($request->file('images'));

            $images->each(function ($image) use ($listing) {

                $path = $image->store('images', 'public');

                $listing->images()->save(new ListingImage([
                  'filename' => $path
              ]));

            });
        }
    }
}
