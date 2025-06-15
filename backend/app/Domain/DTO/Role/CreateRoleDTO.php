<?php

namespace App\Domain\DTO\Role;

class CreateRoleDTO extends \Spatie\LaravelData\Data
{
    public ?string $name = '';
    public ?string $display_name = '';
    public ?string $description = null;



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }



    public function getDisplayName(): ?string
    {
        return $this->display_name;
    }

    /**
     * @param string|null $description
     */
    public function setDisplayName(?string $display_name): void
    {
        $this->display_name = $display_name;
    }
}
