<?php


//use DateTime;

 class PostModel {
    private int $idPost;
    private string $title;
    private string $content;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $idCategory;
    private int $idAuthor;
    private int $upVotes;
    private int $downVotes;
    private bool $status;
    private bool $is_resolved;

    /**
     * @param int $idPost
     * @param string $title
     * @param string $content
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param int $idCategory
     * @param int $idAuthor
     * @param int $upVotes
     * @param int $downVotes
     */
     public function __construct($idAuthor,$title, $content, $upVotes,$status)
     {
         $this->idAuthor = $idAuthor;
         $this->title = $title;
         $this->content = $content;
         $this->upVotes = $upVotes;
         // Set createdAt to today's date
         $this->createdAt = new DateTime();
         // Set updatedAt to today's date
         $this->updatedAt = new DateTime();
         $this->status = $status;
         $this->is_resolved = false;
     }

     public function isIsResolved(): bool
     {
         return $this->is_resolved;
     }

     public function setIsResolved(bool $is_resolved): void
     {
         $this->is_resolved = $is_resolved;
     }

     public function isStatus(): bool
     {
         return $this->status;
     }

     public function setStatus(bool $status): void
     {
         $this->status = $status;
     }



     /**
     * @return int
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * @param int $idPost
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * @param int $idCategory
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }

    /**
     * @return int
     */
    public function getIdAuthor()
    {
        return $this->idAuthor;
    }

    /**
     * @param int $idAuthor
     */
    public function setIdAuthor($idAuthor)
    {
        $this->idAuthor = $idAuthor;
    }

    /**
     * @return int
     */
    public function getUpVotes()
    {
        return $this->upVotes;
    }

    /**
     * @param int $upVotes
     */
    public function setUpVotes($upVotes)
    {
        $this->upVotes = $upVotes;
    }

    /**
     * @return int
     */
    public function getDownVotes()
    {
        return $this->downVotes;
    }

    /**
     * @param int $downVotes
     */
    public function setDownVotes($downVotes)
    {
        $this->downVotes = $downVotes;
    }


}