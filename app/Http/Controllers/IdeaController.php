<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store() {

        $validated = request()->validate([
            "content" => "required|min:3|max:240"
        ]);

        $validated["user_id"] = auth()->id();

        Idea::create($validated);

        return redirect()->route("dashboard")->with("success", "Idea was created seccussfully!");

    }

    public function show(Idea $idea) {

        return view("ideas.show", compact("idea"));
    }

    public function edit(Idea $idea) {

        if (auth()->user()->id != $idea->user_id) {
            abort(404);
        }

        $editing = true;

        return view("ideas.show", compact("idea", "editing"));
    }

    public function destroy(Idea $idea) {

        if (auth()->user()->id != $idea->user_id) {
            abort(404);
        }

        $idea->delete();

        return redirect()->route("dashboard")->with("success", "Idea Deleted Successfully!");
    }

    public function update(Idea $idea) {

        if (auth()->user()->id != $idea->user_id) {
            abort(404);
        }

        $validated = request()->validate([
            "content" => "required|min:3|max:240"
        ]);

        $idea->update($validated);

        return redirect()->route("idea.show", $idea->id)->with("success", "Idea Updated Successfully!");
    }

}
