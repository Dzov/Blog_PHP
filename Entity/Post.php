<?php

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Post
{
    /**
     * @var User
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

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url)
    {
        $this->image_url = $image_url;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }
}
