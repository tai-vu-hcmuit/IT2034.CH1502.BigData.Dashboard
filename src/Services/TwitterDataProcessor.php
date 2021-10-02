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

    public function parseCountCsvDataFile(string $filePath) {
        if (!file_exists($filePath)) {
            throw new \Exception("CSV FILE NOT FOUND");
        }

        $result = [
            'Spark' => [
                TwitModel::SENTIMENT_POSITIVE => 0,
                TwitModel::SENTIMENT_NEGATIVE => 0,
                TwitModel::SENTIMENT_NEUTRAL => 0
            ],
            'Textblob' => [
                TwitModel::SENTIMENT_POSITIVE => 0,
                TwitModel::SENTIMENT_NEGATIVE => 0,
                TwitModel::SENTIMENT_NEUTRAL => 0
            ],
        ];

        foreach (file($filePath) as $line) {

            $line = strrev(trim($line));
            $firstComma = mb_strpos($line, ",");
            $secondComma = mb_strpos(substr($line, $firstComma + 1), ",");

            $textblobResult = strrev(substr($line, 0, $firstComma));
            $sparkResult = strrev(substr($line, $firstComma + 1, $secondComma));

            switch ($sparkResult) {
                case TwitModel::SENTIMENT_POSITIVE:
                    $result['Spark'][TwitModel::SENTIMENT_POSITIVE]++;
                    break;
                case TwitModel::SENTIMENT_NEGATIVE:
                    $result['Spark'][TwitModel::SENTIMENT_NEGATIVE]++;
                    break;
                case TwitModel::SENTIMENT_NEUTRAL:
                    $result['Spark'][TwitModel::SENTIMENT_NEUTRAL]++;
                    break;
                default:
                    break;
            }

            switch ($textblobResult) {
                case TwitModel::SENTIMENT_POSITIVE:
                    $result['Textblob'][TwitModel::SENTIMENT_POSITIVE]++;
                    break;
                case TwitModel::SENTIMENT_NEGATIVE:
                    $result['Textblob'][TwitModel::SENTIMENT_NEGATIVE]++;
                    break;
                case TwitModel::SENTIMENT_NEUTRAL:
                    $result['Textblob'][TwitModel::SENTIMENT_NEUTRAL]++;
                    break;
                default:
                    break;
            }
        }

        return $result;
    }
}