<?php

namespace PHPMaker2021\perkasa2;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * ReportRABStatus controller
 */
class ReportRabStatusController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReportRabStatusSummary");
    }
}
