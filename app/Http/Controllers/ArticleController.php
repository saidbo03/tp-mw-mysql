<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')
            ->latest()
            ->paginate(5);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('articles.index')
            ->with('success', 'Article créé.');
    }

    public function show(Article $article)
    {
        $article->load('user');
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // delete old
            if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Article modifié.');
    }

    public function destroy(Article $article)
    {
        if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article supprimé.');
    }
}
