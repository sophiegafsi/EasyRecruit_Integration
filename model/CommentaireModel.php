<?php

class CommentaireModel {
    private int $idComment;
    private int $idUser;
    private string $content;
    private DateTime $createdAt;
    private int $idPost;

    /**
     * @param int $idUser
     * @param string $content
     * @param DateTime $createdAt
     * @param int $idPost
     */
    public function __construct(int $idUser, string $content, DateTime $createdAt, int $idPost)
    {
        $this->idUser = $idUser;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->idPost = $idPost;
    }

    public function getIdComment(): int
    {
        return $this->idComment;
    }

    public function setIdComment(int $idComment): void
    {
        $this->idComment = $idComment;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getIdPost(): int
    {
        return $this->idPost;
    }

    public function setIdPost(int $idPost): void
    {
        $this->idPost = $idPost;
    }



}
