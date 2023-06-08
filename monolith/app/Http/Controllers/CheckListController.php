<?php

namespace App\Http\Controllers;

use App\Models\CheckList;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new JsonResponse(CheckList::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string|max:255',
           'user_id' => 'required|exists:users,id'
        ]);

        $checkList = CheckList::create($request->all());

        return new JsonResponse($checkList, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new JsonResponse(CheckList::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
         ]);

         $checklist = CheckList::findOrFail($id);

         $checklist->name = $request->get('name');
         $checklist->save();

         return new JsonResponse($checklist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $checklist = CheckList::findOrFail($id);
        $checklist->delete();

        return new JsonResponse(null, 204);
    }
}
