<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articleSubject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articleTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $articleContent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $articleState;

    /**
     * @ORM\Column(type="integer")
     */
    private $articleNbViews;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articleImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleSubject(): ?string
    {
        return $this->articleSubject;
    }

    public function setArticleSubject(string $articleSubject): self
    {
        $this->articleSubject = $articleSubject;

        return $this;
    }

    public function getArticleTitle(): ?string
    {
        return $this->articleTitle;
    }

    public function setArticleTitle(string $articleTitle): self
    {
        $this->articleTitle = $articleTitle;

        return $this;
    }

    public function getArticleContent(): ?string
    {
        return $this->articleContent;
    }

    public function setArticleContent(string $articleContent): self
    {
        $this->articleContent = $articleContent;

        return $this;
    }

    public function getArticleState(): ?bool
    {
        return $this->articleState;
    }

    public function setArticleState(bool $articleState): self
    {
        $this->articleState = $articleState;

        return $this;
    }

    public function getArticleNbViews(): ?int
    {
        return $this->articleNbViews;
    }

    public function setArticleNbViews(int $articleNbViews): self
    {
        $this->articleNbViews = $articleNbViews;

        return $this;
    }

    public function getArticleImage(): ?string
    {
        return $this->articleImage;
    }

    public function setArticleImage(?string $articleImage): self
    {
        $this->articleImage = $articleImage;

        return $this;
    }
}
