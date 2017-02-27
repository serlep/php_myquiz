<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * guess
 *
 * @ORM\Table(name="guess")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\guessRepository")
 */
class guess
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255)
     */
    private $answer;

    /**
     * @var string
     *
     * @ORM\Column(name="wrong", type="string", length=255)
     */
    private $wrong;

    /**
     * @var string
     *
     * @ORM\Column(name="wrong2", type="string", length=255)
     */
    private $wrong2;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $created;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return guess
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return guess
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return guess
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set wrong
     *
     * @param string $wrong
     *
     * @return guess
     */
    public function setWrong($wrong)
    {
        $this->wrong = $wrong;

        return $this;
    }

    /**
     * Get wrong
     *
     * @return string
     */
    public function getWrong()
    {
        return $this->wrong;
    }

    /**
     * Set wrong2
     *
     * @param string $wrong2
     *
     * @return guess
     */
    public function setWrong2($wrong2)
    {
        $this->wrong2 = $wrong2;

        return $this;
    }

    /**
     * Get wrong2
     *
     * @return string
     */
    public function getWrong2()
    {
        return $this->wrong2;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return guess
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return guess
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}

