<?php

namespace App\Domain\DTO\User;

use Spatie\LaravelData\Data;

class UpdateUserDTO extends \Spatie\LaravelData\Data
{
    public string $first_name;
    public ?string $last_name = null;
    public ?string $gender = null;
    public ?string $address = null;

    /**
     * @param string|null $last_name
     */
    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @param int|null $room_id
     */
    public function setRoomId(?int $room_id): void
    {
        $this->room_id = $room_id;
    }
    public ?string $birth_date = null;
    public string $phone_number;
    public ?int $room_id = null;
    public ?int $city_id = null;
    public ?int $user_status_id = null;

    public int $id;


    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }


    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param string $birth_date
     */
    public function setBirthDate(string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }

    /**
     * @param string $phone_number
     */
    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }


    /**
     * @param int $city_id
     */
    public function setCityId(int $city_id): void
    {
        $this->city_id = $city_id;
    }

    /**
     * @param int $user_status_id
     */
    public function setUserStatusId(int $user_status_id): void
    {
        $this->user_status_id = $user_status_id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}