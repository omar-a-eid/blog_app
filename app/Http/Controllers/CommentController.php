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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateComment($request, 'store');

        $this->commentRepository->create($validatedData);

        return $this->redirectBackWithMessage('Comment added successfully!', 'success', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = $this->commentRepository->find($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $this->validateComment($request, "update");

        $comment = $this->commentRepository->find($id);

        if (!$comment) {
            return $this->redirectBackWithMessage('Comment not found.', 'error', false, $comment);
        }

        $updated = $this->commentRepository->update($id, $validatedData);

        if (!$updated) {
            return $this->redirectBackWithMessage('Failed to update comment.', 'error', false, $comment);
        }

        return $this->redirectBackWithMessage('Comment updated successfully!', 'success', false, $comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = $this->commentRepository->find($id);

        if (!$comment) {
            return $this->redirectBackWithMessage('Comment not found.', 'error', true);
        }

        $deleted = $this->commentRepository->delete($id);

        if (!$deleted) {
            return $this->redirectBackWithMessage('Failed to delete comment.', 'error', true);
        }

        return $this->redirectBackWithMessage('Comment deleted successfully!', 'success', true);
    }

    private function validateComment(Request $request, string $action)
    {
        $rules = [
            'content' => 'required|string|max:1000',
        ];

        // Add post_id validation only for store action (not for update)
        if ($action === 'store') {
            $rules['post_id'] = 'required|exists:posts,id';
        }

        return $request->validate($rules, [
            'content.required' => 'Please provide content for the comment.',
            'content.max' => 'The comment content cannot exceed 1000 characters.',
            'post_id.required' => 'A post ID is required.',
            'post_id.exists' => 'The specified post does not exist.',
        ]);
    }
    

    private function redirectBackWithMessage($message, $type = 'error', $useBack = false, $comment = null,)
    {
        if ($useBack) {
            // Redirect to the previous page
            return redirect()->back()->with($type, $message);
        } else {
            // Redirect to the posts.show route by default
            $routeParams = ['post' => optional($comment)->post_id];
            return redirect()->route('posts.show', $routeParams)->with($type, $message);
        }
    }
}
