<?php

namespace App\Http\Controllers;

use App\Actions\ListItem\CreateListItemAction;
use App\Actions\ListItem\DeleteListItemAction;
use App\Actions\ListItem\UpdateListItemAction;
use App\DTOs\ListItemDTO;
use App\Events\ListUpdated;
use App\Http\Requests\CreateListItemRequest;
use App\Http\Requests\UpdateListItemRequest;
use App\Http\Resources\ListItemResource;
use App\Models\ListItem;
use App\Repositories\ListTitleRepository;


class ListItemController extends Controller
{
    public function __construct(
        protected ListTitleRepository  $listRepository,
        protected CreateListItemAction $createListItemAction,
        protected UpdateListItemAction $updateListItemAction,
        protected DeleteListItemAction $deleteListItemAction
    )
    {
    }

    public function store(CreateListItemRequest $createListItemRequest)
    {
        $listItem = $this->createListItemAction->run(ListItemDTO::fromRequest($createListItemRequest));

        broadcast(new ListUpdated($listItem))->toOthers();

        return $this->created(
            ListItemResource::make($listItem)
        );
    }

    public function update(UpdateListItemRequest $updateListItemRequest, $list_title_id,ListItem $listItem)
    {
        $listItem = $this->updateListItemAction->run(ListItemDTO::fromRequest($updateListItemRequest), $listItem);

        broadcast(new ListUpdated($listItem))->toOthers();

        return $this->ok(
            ListItemResource::make($listItem)
        );
    }

    public function delete($list_title_id,ListItem $listItem)
    {
        $this->deleteListItemAction->run($listItem);

        broadcast(new ListUpdated($listItem))->toOthers();

        return $this->noContent();
    }
}
