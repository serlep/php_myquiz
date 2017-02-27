<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * siglesfrancais
 *
 * @ORM\Table(name="siglesfrancais")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\siglesfrancaisRepository")
 */
class siglesfrancais
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return siglesfrancais
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
     * @return siglesfrancais
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
     * @return siglesfrancais
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
     * @return siglesfrancais
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
}

