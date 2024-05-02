<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function store(TagRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => ($request->has('description')) ? $request->description : null,
        ];
        $tag = Tag::query()->create($data);
        return $this->created($tag);
    }

    public function index()
    {
        $tags = Tag::all();
        return $this->ok($tags);
    }


    public function show(Tag $tag)
    {
        $tag['balance'] = $tag->getSumTagTransactionAttribute();
        return $this->ok($tag);
    }

    public function update(Tag $tag , TagRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->has($request->description) ? $request->description : null,
        ];

        $tag->update($data);

        return $this->ok($tag);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
        return $this->noContent();
    }
}

