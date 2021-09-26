<?php


namespace App\Services;


class TwitModel
{
    public const SENTIMENT_POSITIVE = 'positive';
    public const SENTIMENT_NEGATIVE = 'negative';
    public const SENTIMENT_NEUTRAL = 'neutral';


    var $content;
    var $sentiment;

    public function __construct(string $content, $sentiment) {
        $this->content = $content;
        $this->sentiment = $sentiment;
    }
}