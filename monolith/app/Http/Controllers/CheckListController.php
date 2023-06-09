<?php

namespace App\Http\Controllers;

use App\Models\CheckList;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['data' => CheckList::all()]);
    }

    public function show(Request $request, $id)
    {
        $checkList = CheckList::with(['items','user'])->findOrFail($id);
        return response()->json($checkList);
    }

    public function create(Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id']
        ]);

        $checkList = CheckList::create($validatedData);

        return response()->json(['message' => 'List created', 'data' => $checkList]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validate($request, [
            'name' => ['required', 'string']
        ]);

        $checkList = CheckList::findOrFail($id);
        $checkList->name = $validatedData['name'];
        $checkList->save();

        return response()->json(['message' => 'List updated', 'data' => $checkList]);
    }

    public function delete($id)
    {
        $checkList = CheckList::findOrFail($id);
        $checkList->delete();

        return response()->json(['message' => 'List deleted']);
    }
}
