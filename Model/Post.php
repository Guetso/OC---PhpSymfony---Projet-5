<?php

namespace Blog\Model;

class Post extends Model
{
    private int $id;
    private string $author;
    private string $title;
    private string $subtitle;
    private string $content;
    private string $createdAt;
    private string $modifiedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Post
    {
        $this->id = $id;
        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): Post
    {
        $this->author = $author;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): Post
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Post
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): Post
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getModifiedAt(): string
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(string $modifiedAt): Post
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }
}
