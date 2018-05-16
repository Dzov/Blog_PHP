<?php

namespace Blog\Entity;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class Comment extends Entity
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
    private $commentId;

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

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function setCommentId(int $id): void
    {
        $this->commentId = $id;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    public function getPostedAt(): \DateTime
    {
        return $this->postedAt;
    }

    public function setPostedAt(\DateTime $postedAt): void
    {
        $this->postedAt = $postedAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
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

