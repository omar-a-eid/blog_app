<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postRepository->all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validatePost($request);

        $this->postRepository->create($validatedData);

        return $this->redirectWithMessage('Post created successfully!', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            return $this->redirectWithMessage('Post not found.', 'error');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            return $this->redirectWithMessage('Post not found.', 'error');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $this->validatePost($request);

        $post = $this->postRepository->find($id);

        if (!$post) {
            return $this->redirectWithMessage('Post not found.', 'error');
        }
    
        $this->postRepository->update($id, $validatedData);
    
        return $this->redirectWithMessage('Post updated successfully!', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            return $this->redirectWithMessage('Post not found.', 'error');
        }

        $this->postRepository->delete($id);
        return $this->redirectWithMessage('Post deleted successfully!', 'success');
    }

    private function validatePost(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:100|min:10',
            'content' => 'required|string|min:30',
        ], [
            'title.required' => 'Please enter a title for the post.',
            'title.max' => 'The title cannot exceed 255 characters.',
            'content.required' => 'Please provide content for the post.',
        ]);
    }

    private function redirectWithMessage($message, $type = 'error')
    {
        return redirect()->route('posts.index')->with($type, $message);
    }
}
