<?php

namespace Blog\Entity;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Comment extends Entity
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
     * @var Post
     */
    private $post;

    /**
     * @var \DateTime
     */
    private $postedAt;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $username;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor($author)
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

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    public function getPosted_at()
    {
        return $this->postedAt;
    }

    public function setPosted_at($postedAt)
    {
        $this->postedAt = $postedAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }
}

