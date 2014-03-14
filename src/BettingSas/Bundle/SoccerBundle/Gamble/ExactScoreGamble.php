<?php

namespace BettingSas\Bundle\SoccerBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Gamble\GambleInterface;
use BettingSas\Bundle\GambleBundle\Document\Bet;

/**
 * Description of ExactScoreGamble
 *
 * @author jobou
 */
class ExactScoreGamble implements GambleInterface
{
    /**
     * Choices available in gamble
     *
     * @var array
     */
    protected $choices = array(
        "1-0",
        "2-0",
        "2-1",
        "3-0",
        "3-1",
        "3-2",
        "4-0",
        "4-1",
        "4-2",
        "4-3",

        "0-0",
        "1-1",
        "2-2",
        "3-3",
        "4-4",
        "5-5",

        "0-1",
        "0-2",
        "1-2",
        "0-3",
        "1-3",
        "2-3",
        "0-4",
        "1-4",
        "2-4",
        "3-4",
    );

    /**
     * Get choices available in gamble
     *
     * @return array
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'exact_score';
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:exact_score.html.twig';
    }

    /**
     * {@inheritDoc}
     */
    public function getCartTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:Cart/simple.html.twig';
    }

    /**
     * {@inheritDoc}
     */
    public function processBet(Bet $bet)
    {
        $event = $bet->getEvent();

        $score = $event->getLeftTeamRealScore().'-'.$event->getRightTeamRealScore();
        if ($bet->getChoice() === $score) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(Bet $bet)
    {
        return $this->getName() == $bet->getType() && in_array($bet->getChoice(), $this->getChoices());
    }

    /**
     * {@inheritDoc}
     */
    public function getDifficulty()
    {
        return 15;
    }

}
