<?php

namespace App\Entity;

use App\Repository\DocSearchRepository;
use Doctrine\DBAL\Types\Types;

class DocSearch
{
    private ?int $id = null;

    private ?object $type = null;

    private ?object $level = null;

    private ?object $subject = null;

    private ?object $theme = null;

    private ?string $document_title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?object
    {
        return $this->type;
    }

    public function setType(object $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getLevel(): ?object
    {
        return $this->level;
    }

    public function setLevel(object $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getSubject(): ?object
    {
        return $this->subject;
    }

    public function setSubject(object $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getTheme(): ?object
    {
        return $this->theme;
    }

    public function setTheme(object $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getDocumentTitle(): ?string
    {
        return $this->document_title;
    }

    public function setDocumentTitle(string $document_title): static
    {
        $this->document_title = $document_title;

        return $this;
    }
}
