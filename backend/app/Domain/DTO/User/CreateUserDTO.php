<?php

namespace App\Domain\DTO\User;


class CreateUserDTO extends \Spatie\LaravelData\Data
{
    public string $first_name;
    public string $last_name;
    public string $password;
    public ?string $gender = null;
    public ?string $address = null;
    public ?string $birth_date = null;
    public string $phone_number;
    public ?int $room_id = null;
    public ?int $city_id = null;
    public ?int $user_status_id = null;

    /**
     * @param int $user_status_id
     */
    public function setUserStatusId(int $user_status_id): void
    {
        $this->user_status_id = $user_status_id;
    }


    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
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
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param string $room_id
     */
    public function setRoomId(string $room_id): void
    {
        $this->room_id = $room_id;
    }

    /**
     * @param string $city_id
     */
    public function setCityId(string $city_id): void
    {
        $this->city_id = $city_id;
    }
}
