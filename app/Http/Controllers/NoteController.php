<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteController extends Controller
{

    public function index():JsonResource
    {
        // $notes = Note::all();
        // return response()->json($notes, 200);
        return NoteResource::collection(Note::all());
    }

    public function store(NoteRequest $request):JsonResponse
    {
        $note = Note::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Note created successfully.',
            'data' => new NoteResource($note)],
            
             201);
    }


    public function show(string $id):JsonResponse
    {
        $note = Note::find($id);
        return response()->json($note, 200);
    }

    public function update(NoteRequest $request, string $id):JsonResponse
    {
        $note = Note::find($id);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();
        return response()->json([
            'success' => true,
            'message' => 'Note updated successfully.',
            'data' => $note],
            200
        );
    }

    public function destroy(string $id):JsonResponse
    {
        Note::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Note deleted successfully.'],
            200
        );
    }
}
