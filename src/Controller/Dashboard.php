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

    public function __construct(
        FileService $fileService,
        TwitterDataProcessor $twitterDataProcessor
    ) {
        $this->fileService = $fileService;
        $this->twitterDataProcessor = $twitterDataProcessor;
    }

    /**
     * @Route("dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . "data";
        $files = $this->fileService->listAllFileNamesInDirectory($path);

        $parsedData = $this->twitterDataProcessor->parseDataFromFiles($path, $files);
        $countPositive = count($parsedData[TwitModel::SENTIMENT_POSITIVE]);
        $countNegative = count($parsedData[TwitModel::SENTIMENT_NEGATIVE]);
        $countNeutral = count($parsedData[TwitModel::SENTIMENT_NEUTRAL]);

        return $this->render('base.html.twig', [
            'countPositive' => $countPositive,
            'countNegative' => $countNegative,
            'countNeutral' => $countNeutral
        ]);
    }
}