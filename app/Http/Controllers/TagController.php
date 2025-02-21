<?php

namespace App\Http\Controllers;

use App\Actions\Tag\CreateTagAction;
use App\Actions\Tag\DeleteTagAction;
use App\Actions\Tag\UpdateTagAction;
use App\DTOs\TagDTO;
use App\Http\Requests\CreateTagRequest;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TagController extends Controller
{
    public function __construct(protected CreateTagAction $createTagAction,
                                protected UpdateTagAction $updateTagAction,
                                protected DeleteTagAction $deleteTagAction,
                                protected TagRepository $tagRepository)
    {
    }

    public function store(CreateTagRequest $request)
    {
        $tag = $this->createTagAction->run(TagDTO::fromRequest($request));

        return $this->created(TagResource::make($tag));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        $callback = function ($query) {
            $query->where('user_id', auth()->id());
        };
        $tags = $this->tagRepository->paginate($request->limit, $callback);

        return $this->ok(
            TagCollection::make($tags)
                ->resource
        );
    }


    public function show(Tag $tag)
    {
        $tag = $this->tagRepository->getOneByModelBinding($tag);
        return $this->ok(TagResource::make($tag));
    }

    public function update(Tag $tag , CreateTagRequest $request)
    {
        $tag = $this->updateTagAction->run(TagDTO::fromRequest($request), $tag);

        return $this->ok(TagResource::make($tag));
    }

    public function delete(Tag $tag)
    {
        $this->deleteTagAction->run($tag);

        return $this->noContent();
    }
}

