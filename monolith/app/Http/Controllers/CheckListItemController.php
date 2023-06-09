<?php

namespace App\Http\Controllers;

use App\Models\CheckListItem;
use Illuminate\Http\Request;

class CheckListItemController extends Controller
{
    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string'],
            'check_list_id' => ['required', 'exists:check_lists,id']
        ]);

        $item = CheckListItem::create($data);

        return response()->json(['message' => 'Item created', 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string']
        ]);

        $item = CheckListItem::findOrFail($id);
        $item->name = $data['name'];
        $item->save();

        return response()->json(['message' => 'Item updated', 'data' => $item]);
    }

    public function delete($id)
    {
        $item = CheckListItem::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted']);
    }

    public function finish($id)
    {
        $item = CheckListItem::findOrFail($id);
        $item->is_completed = true;
        $item->save();

        return response()->json(['messsage' => 'Item finished']);
    }

    public function unfinish($id)
    {
        $item = CheckListItem::findOrFail($id);
        $item->is_completed = false;
        $item->save();

        return response()->json(['messsage' => 'Item unfinished']);
    }
}
