<?php

namespace App\Actions\Tag;

use App\Models\Tag;

class DeleteTagAction
{
    public function run(Tag $tag): ?bool
    {
        return $tag->delete();
    }
}
