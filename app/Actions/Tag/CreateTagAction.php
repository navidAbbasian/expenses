<?php

namespace App\Actions\Tag;

use App\DTOs\TagDTO;
use App\Models\Tag;

class CreateTagAction
{
    public function run(TagDTO $tagDTO): Tag
    {
      $tag = $tagDTO->toModel();

      $tag->save();
      $tag->refresh();

      return $tag;
    }
}
