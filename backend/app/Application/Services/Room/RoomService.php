<?php

namespace App\Application\Services\Room;

use App\Domain\DTO\Room\CreateRoomDTO;
use App\Domain\DTO\Room\UpdateRoomDTO;
use App\Domain\Filter\Room\RoomFilter;
use App\Domain\Interfaces\Room\RoomServiceInterface;
use App\Domain\State\RoomStatuses;
use App\Infrastructure\Repository\Room\RoomRepository;
use Illuminate\Support\Facades\Lang;

class RoomService implements RoomServiceInterface
{
    /**
     */
    public function __construct(
        private RoomRepository $roomRepository
    ) {}

    public function getRoom()
    {
        $this->roomRepository->setWith(['department']);
        return $this->roomRepository->paginate();
    }

    /**
     * @returnmixed
     */
    public function getRooms(RoomFilter $roomFilter = null)
    {
        if ($roomFilter != null)
            return $this->roomRepository->getFilterItems($roomFilter);
        else
            return $this->roomRepository->paginate();
    }

    public function createRoom(CreateRoomDTO $data)
    {
        $room = $this->roomRepository->create($data->toArray());
        return $room->load('department');
    }

    public function updateRoom(int $id, UpdateRoomDTO $data)
    {
        $originalRoom = $this->roomRepository->getById($id);
        if ($originalRoom->status != $data->status && $data->status == RoomStatuses::INACTIVE_Room && $originalRoom->count > 0) {
            throw new \Exception(Lang::get('messages.cannotDeactivateRoomError'), 400);
        }

        $room = $this->roomRepository->updateById($id, $data->toArray());
        return $room->load('department');
    }
    public function showRoom(int $id)
    {

        return $this->roomRepository->getById($id)->load('department');
    }
    public function getRoomsByIds(array $ids)
    {
        return $this->roomRepository->whereIn('id', $ids)->with(['department'])->get();
    }

    /**
     * @throws\Exception
     */
    public function deleteRoom(int $id)
    {
        return $this->roomRepository->deleteById($id);
    }
}