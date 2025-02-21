<?php

namespace App\Http\Controllers;

use App\Actions\List\CreateListAction;
use App\Actions\List\DeleteListAction;
use App\Actions\List\UpdateListAction;
use App\DTOs\ListTitleDTO;
use App\Http\Requests\CreateListRequest;
use App\Http\Requests\UpdateListRequest;
use App\Http\Resources\ListCollection;
use App\Http\Resources\ListResource;
use App\Models\ListTitle;
use App\Repositories\ListTitleRepository;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ListController extends Controller
{
    public function __construct(
        protected ListTitleRepository $listRepository,
        protected CreateListAction    $createListAction,
        protected UpdateListAction    $updateListAction,
        protected DeleteListAction    $deleteListAction,
    )
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        return $this->ok(ListCollection::make($this->listRepository->paginate($request->limit)));
    }

    public function show(ListTitle $listTitle)
    {
        return $this->ok(ListResource::make($listTitle));
    }

    public function store(CreateListRequest $createListRequest)
    {
        $list = $this->createListAction->run(listTitleDto: ListTitleDTO::fromRequest($createListRequest));

        return $this->created(
            ListResource::make($list)
        );
    }

    public function update(UpdateListRequest $updateListRequest,  ListTitle $listTitle)
    {
        $list = $this->updateListAction->run(listTitleDTO:  ListTitleDTO::fromRequest($updateListRequest),list:  $listTitle);

        return $this->ok(
            ListResource::make($list)
        );
    }

    public function delete(ListTitle $listTitle)
    {
        $this->deleteListAction->run($listTitle);

        return $this->noContent();
    }
}
