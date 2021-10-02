<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\TwitModel;
use App\Services\TwitterDataProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\FileService;

/**
 * @Route("/")
 */
class Dashboard extends AbstractController
{
    var $fileService;
    var $twitterDataProcessor;

    var $folderPathJson = '';
    var $resultCsvFilePath = '';

    public function __construct(
        FileService $fileService,
        TwitterDataProcessor $twitterDataProcessor
    ) {
        $this->fileService = $fileService;
        $this->twitterDataProcessor = $twitterDataProcessor;

        $this->folderPathJson = dirname(__DIR__) . DIRECTORY_SEPARATOR . "data";
        $this->resultCsvFilePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "Spark_TextBlob_Result_csv.csv";
    }

    /**
     * @Route("dashboard", name="dashboard")
     */
    public function dashboard()
    {
//        $files = $this->fileService->listAllFileNamesInDirectory($this->folderPathJson);
//        $parsedData = $this->twitterDataProcessor->parseDataFromFiles($this->folderPathJson, $files);
//        $countPositive = count($parsedData[TwitModel::SENTIMENT_POSITIVE]);
//        $countNegative = count($parsedData[TwitModel::SENTIMENT_NEGATIVE]);
//        $countNeutral = count($parsedData[TwitModel::SENTIMENT_NEUTRAL]);

        $csvDataCount = $this->twitterDataProcessor->parseCountCsvDataFile($this->resultCsvFilePath);

        return $this->render('base.html.twig', [
            'SparkCountPositive' => $csvDataCount['Spark'][TwitModel::SENTIMENT_POSITIVE],
            'SparkCountNegative' => $csvDataCount['Spark'][TwitModel::SENTIMENT_NEGATIVE],
            'SparkCountNeutral' => $csvDataCount['Spark'][TwitModel::SENTIMENT_NEUTRAL],
            'TextblobCountPositive' => $csvDataCount['Textblob'][TwitModel::SENTIMENT_POSITIVE],
            'TextblobCountNegative' => $csvDataCount['Textblob'][TwitModel::SENTIMENT_NEGATIVE],
            'TextblobCountNeutral' => $csvDataCount['Textblob'][TwitModel::SENTIMENT_NEUTRAL],
        ]);
    }
}