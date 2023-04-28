<?php

namespace App\Http\Controllers;

use App\Actions\UpsertListingImageAction;
use App\Http\Requests\UpsertListingImageRequest;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RealtorListingImageController extends Controller
{
    public function __construct(private readonly UpsertListingImageAction $upsertListingImageAction)
    {
    }

    public function create(Listing $listing)
    {
        $listing->load(['images']);

        return Inertia::render(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Request $request, Listing $listing)
    {
        if ($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:jpg,png,jpeg,webp|max:5000'
            ], [
                'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg, webp'
            ]);
        }
        $this->upsert($request, $listing);

        return redirect()->back()->with('success', 'Images uploaded!');
    }

    public function upsert(Request $request, Listing $listing)
    {
        $this->upsertListingImageAction->execute($request, $listing);
    }


    public function destroy($listing, ListingImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
