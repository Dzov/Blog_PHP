<?php

namespace Blog\Entity;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Post extends Entity
{
    /**
     * @var int
     */
    private $author;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $image_url;

    /**
     * @var string
     */
    private $subtitle;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var string
     */
    private $username;

    public function getAuthor(): int
    {
        return $this->author;
    }

    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPost_id(): int
    {
        return $this->id;
    }

    public function setPost_id(int $id): void
    {
        $this->id = $id;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}

