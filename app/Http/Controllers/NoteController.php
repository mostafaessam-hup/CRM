<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteController extends Controller
{
    public function index(Request $request, $customerId)
    {
        return Note::where('customer_id', $customerId)->get();
    }

    public function show($customerId, $id)
    {
        $Note = Note::find($id);
        if (!$Note) {
            return response()->json(['status' => 'note not found'], Response::HTTP_NOT_FOUND);
        }

        $customerId = (int)$customerId;
        if ($Note->customer_id !== $customerId) {
            return response()->json(['status' => 'invalid data'], Response::HTTP_BAD_REQUEST);
        }
        return Note::find($id) ??
            response()->json(['status' => 'not found'], Response::HTTP_NOT_FOUND);
    }

    public function create(Request $request, $customerId)
    {
        $Note = new Note();
        $Note->note = $request->get('note');
        $Note->customer_id = $customerId;
        $Note->save();

        return $Note;
    }

    public function update(Request $request, $customerId, $id)
    {
        $Note = Note::find($id);

        if (!$Note) {
            return response()->json(['status' => 'note not found'], Response::HTTP_NOT_FOUND);
        }

        $customerId = (int)$customerId;
        if ($Note->customer_id !== $customerId) {
            return response()->json(['status' => 'invalid data'], Response::HTTP_BAD_REQUEST);
        }

        $Note->note = $request->get('note');
        $Note->save();

        return $Note;
    }

    public function delete(Request $request, $customerId, $id)
    {
        $Note = Note::find($id);
        if (!$Note) {
            return response()->json(['status' => 'note not found'], Response::HTTP_NOT_FOUND);
        }
        $customerId=(int)$customerId;
        if ($Note->customer_id != $customerId) {
            return response()->json(['status' => 'invalid data'], Response::HTTP_BAD_REQUEST);
        }

        $Note->delete();
        return response()->json(['status' => 'deleted'], Response::HTTP_OK);
    }
}
