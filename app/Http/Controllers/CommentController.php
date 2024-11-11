<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:1000',
        ], [
            'post_id.required' => 'A post ID is required.',
            'post_id.exists' => 'The specified post does not exist.',
            'content.required' => 'Please provide content for the comment.',
            'content.max' => 'The comment content cannot exceed 1000 characters.',
        ]);

        $this->commentRepository->create($validatedData);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:1000',
        ], [
            'content.required' => 'Please provide content for the comment.',
            'content.max' => 'The comment content cannot exceed 1000 characters.',
        ]);

        $updated = $this->commentRepository->update($id, $validatedData);

        if (!$updated) {
            return redirect()->back()->with('error', 'Failed to update comment.');
        }

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->commentRepository->delete($id);

        if (!$deleted) {
            return redirect()->back()->with('error', 'Failed to delete comment.');
        }

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
