<?php
declare(strict_types=1);

namespace app\modules\blog\controllers;


class CommentController extends Controller
{
    private $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
        $this->serviceConverter = $service;
    }

    public function actionIndex()
    {
        return $this->controller->render('index', [
            'tests' => $this->service->getTests()
        ]);
    }
}