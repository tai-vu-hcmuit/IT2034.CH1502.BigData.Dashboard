<?php
declare(strict_types=1);

namespace App\Services;


class TwitterDataProcessor
{
    public function __construct(
    ) {

    }

    public function parseDataFromFiles(string $path, array $files) {
        $result = [
            TwitModel::SENTIMENT_POSITIVE => [],
            TwitModel::SENTIMENT_NEGATIVE => [],
            TwitModel::SENTIMENT_NEUTRAL => [],
        ];

        foreach ($files as $file) {
            $fullPath = $path . DIRECTORY_SEPARATOR .$file;
            foreach (file($fullPath) as $line) {
                $jsonData = json_decode($line, true);

                if ($jsonData === null) {
                    continue;
                }

                $document = $jsonData['document'] ?? null;
                $sentiment = $jsonData['sentiment'] ?? null;
                if (!$document || !$sentiment) {
                    continue;
                }

                switch ($jsonData['sentiment']) {
                    case TwitModel::SENTIMENT_POSITIVE:
                        $entity = new TwitModel($jsonData['document'], TwitModel::SENTIMENT_POSITIVE);
                        $result[TwitModel::SENTIMENT_POSITIVE][] = $entity;
                        break;
                    case TwitModel::SENTIMENT_NEGATIVE:
                        $entity = new TwitModel($jsonData['document'], TwitModel::SENTIMENT_NEGATIVE);
                        $result[TwitModel::SENTIMENT_NEGATIVE][] = $entity;
                        break;
                    case TwitModel::SENTIMENT_NEUTRAL:
                        $entity = new TwitModel($jsonData['document'], TwitModel::SENTIMENT_NEUTRAL);
                        $result[TwitModel::SENTIMENT_NEUTRAL][] = $entity;
                        break;
                    default:
                        break;
                }
            }
        }

        return $result;
    }
}