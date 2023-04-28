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
use Inertia\Inertia;
use Inertia\Response;

class RealtorListingController extends Controller
{
    public function __construct(private readonly UpsertListingAction $upsertListingAction)
    {
        $this->authorizeResource(Listing::class, 'listing');
    }


    /**
     * @return Response
     */
    public function index(Request $request): Response
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return Inertia::render(
            'Realtor/Index',
           [  'filters' => $filters,
               'listings' => Auth::user()
               ->listings()
               ->filter($filters)
               ->withCount('images')
               ->withCount('offers')
               ->paginate(5)
               ->withQueryString()
           ]
        );
    }

    public function show(Listing $listing)
    {
        return Inertia::render(
            'Realtor/Show',
            ['listing' => $listing->load('offers', 'offers.bidder')]
        );
    }

    public function create(): Response
    {
        return Inertia::render('Realtor/Create');
    }

    public function store (UpsertListingRequest $request): RedirectResponse
    {
        $this->upsert($request, new Listing());

        return Redirect::route('realtor.listings.index')->with('success', 'Listing created.');
    }

    public function edit (Listing $listing): Response
    {
        return Inertia::render(
            'Realtor/Edit',
            [
                'listing' => $listing
            ],
        );
    }

    public function update(UpsertListingRequest $request, Listing $listing):RedirectResponse
    {
        $this->upsert($request, $listing);

        return Redirect::route('realtor.listings.index')->with('success', 'Listing updated.');

    }


    /**
     * @param Listing $listing
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroy(Listing $listing): RedirectResponse
    {
        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }

    public function upsert(UpsertListingRequest $request, Listing $listing): void
    {
        $listingData = new ListingData(...$request->validated());

        $this->upsertListingAction->execute($listingData, $listing);
    }

}
