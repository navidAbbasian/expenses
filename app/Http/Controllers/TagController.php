<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $tags = Tag::query();

        $pagination = $this->pagination($tags, $request);

        return $this->ok($pagination);
    }


    public function show(Tag $tag)
    {
        return $this->ok($tag);
    }

    public function update(Tag $tag , TagRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->has('description') ? $request->description : $tag->description,
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

