<?php

namespace App\Actions\Tag;

use App\DTOs\TagDTO;
use App\Models\Tag;

class UpdateTagAction
{
    public function run(TagDTO $tagDTO, Tag $tag): Tag
    {
        $tag->name = $tagDTO->name ?? $tag->name;
        $tag->description = $tagDTO->description ?? $tag->description;

        $tag->save();
        $tag->refresh();

        return $tag;
    }
}
