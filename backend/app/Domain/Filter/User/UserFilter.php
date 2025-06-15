<?php

namespace App\Domain\Filter\User;

class UserFilter extends \App\Domain\Filter\OthersBaseFilter
{
    public ?string $first_name;
    public ?string $last_name;
    public ?string $gender;
    public ?string $birth_date;
    public ?string $phone_number;
    public ?int $room_id;
    public ?int $city_id;
    public ?int $status_id;
    public ?string $address;

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string|null $first_name
     */
    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string|null $last_name
     */
    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birth_date;
    }

    /**
     * @param string|null $birth_date
     */
    public function setBirthDate(?string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    /**
     * @param string|null $phone_number
     */
    public function setPhoneNumber(?string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return int|null
     */
    public function getRoomId(): ?int
    {
        return $this->room_id;
    }

    /**
     * @param int|null $room_id
     */
    public function setRoomId(?int $room_id): void
    {
        $this->room_id = $room_id;
    }

    /**
     * @return int|null
     */
    public function getCityId(): ?int
    {
        return $this->city_id;
    }

    /**
     * @param int|null $city_id
     */
    public function setCityId(?int $city_id): void
    {
        $this->city_id = $city_id;
    }

    /**
     * @return int|null
     */
    public function getStatusId(): ?int
    {
        return $this->status_id;
    }

    /**
     * @param int|null $status_id
     */
    public function setStatusId(?int $status_id): void
    {
        $this->status_id = $status_id;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }
}