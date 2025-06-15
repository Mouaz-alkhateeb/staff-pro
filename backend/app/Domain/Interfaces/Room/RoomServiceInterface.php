<?php

namespace App\Domain\Interfaces\Room;

use App\Domain\DTO\Room\CreateRoomDTO;
use App\Domain\DTO\Room\UpdateRoomDTO;
use App\Domain\Filter\Room\RoomFilter;

interface RoomServiceInterface
{
    public function getRoom();
    public function createRoom(CreateRoomDTO $data);
    public function updateRoom(int $id, UpdateRoomDTO $data);
    public function deleteRoom(int $id);
    public function showRoom(int $id);
    public function getRooms(RoomFilter $roomFilter);
}