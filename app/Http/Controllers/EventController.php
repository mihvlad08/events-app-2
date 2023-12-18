<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event as Event;
use App\Models\User as User;
use App\Models\Speaker as Speaker;
use App\Models\Sponsor as Sponsor;
use Illuminate\Support\Facades\Session;
use App\Models\Partner as Partner;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $event = new Event();

        $event->name = $request->only("name")["name"];
        $event->description = $request->only("description")["description"];
        $event->location = $request->only("location")["location"];
        $event->price = $request->only("price")["price"];
        $event->event_date = $request->only("date")["date"];
        $event->event_time = $request->only("time")["time"];

        $event->save();

        $sponsorsString = $request->input("sponsors");
        $sponsors = explode(",", $sponsorsString);

        $speakersString = $request->input("speakers");
        $speakers = explode(",", $speakersString);

        $partnersString = $request->input("partners");
        $partners = explode(",", $partnersString);

        foreach ($sponsors as $sponsor) {
            $sponsorModel = new Sponsor();
            $sponsorModel->name = $sponsor;
            $sponsorModel->event_id = $event->getId(); // Access the id directly from the saved event
            $sponsorModel->save();
        }

        foreach ($speakers as $speaker) {
            $speakerModel = new Speaker();
            $speakerModel->name = $speaker;
            $speakerModel->event_id = $event->getId(); // Access the id directly from the saved event
            $speakerModel->save();
        }

        foreach ($partners as $partner) {
            $partnerModel = new Partner();
            $partnerModel->name = $partner;
            $partnerModel->event_id = $event->getId(); // Access the id directly from the saved event
            $partnerModel->save();
        }

        return redirect("/adminDashboard")->with(
            "message",
            "Successfully created a new event"
        );
    }

    public function deleteAll()
    {
        Event::deleteAllEvents();
        return redirect()
            ->back()
            ->with("message", "Successfully deleted all events");
    }

    public function deleteEvent($var1)
    {
        Event::deleteEvent($var1);

        return redirect()
            ->back()
            ->with("message", "Successfully deleted the event");
    }

    public function editEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            abort(404);
        }
        return view("admin/editEvent", ["event" => $event]);
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            abort(404);
        }
        $event->update([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "location" => $request->input("location"),
            "price" => $request->input("price"),
        ]);

        return redirect()
            ->route("seeEvents")
            ->with("message", "Event updated successfully.");
    }

    public function addToCart(Request $request)
    {
        // 1. Validation
        $request->validate([
            "id" => "required",
            "quantity" => "required|numeric|min:1",
        ]);

        // 2. Refactor variable assignments
        $productId = $request->input("id");
        $productQty = $request->input("quantity");
        $productPrice = $request->input("price");

        // 3. Simplify user information retrieval
        $user = auth()
            ->guard("admin2")
            ->user();
        $userId = $user->id;

        // 4. Improve cart data handling
        $cartKey = "cart_" . $userId; // Unique cart key for each user
        $cartData = Session::get($cartKey, []);

        // Check if the product is already in the cart
        if (isset($cartData[$productId])) {
            // Update quantity if the product is already in the cart
            $cartData[$productId]["quantity"] += $productQty;
        } else {
            // Add a new product to the cart
            $cartData[$productId] = [
                "id" => $productId,
                'price' => $productPrice,
                "quantity" => $productQty,
                // Include other product details as needed
            ];
        }

        // Update the cart in the session
        Session::put($cartKey, $cartData);
        \Log::info('User ' . $user->name . ' added ' . $productQty . ' of event with id=' . $productId . ' to cart, price per event is ' . $productPrice);

        return redirect()->back();
    }

    public function removeCart(Request $request)
    {
        $user = auth()
            ->guard("admin2")
            ->user();
        $userId = $user->id;

        $cartKey = "cart_" . $userId;
        $cartData = Session::get($cartKey, []);

        $productId = $request->input("id");

        $cartData[$productId]["quantity"] = 0;

        Session::put($cartKey, $cartData);
        \Log::info('User ' . $user->name . ' removed his cart, eventID = ' . $productId . '.');

        return redirect()->back();
    }
}
