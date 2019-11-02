<?php

declare(strict_types=1);

namespace Interfaces\Web\RequestHandlers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use SebastiaanLuca\Flow\Http\Enforcers\EnforcesRequests;
use SebastiaanLuca\Flow\Http\Interactions\InteractsWithRequests;
use SebastiaanLuca\Flow\Http\RequestHandlers\RequestHandler as BaseRequestHandler;

abstract class RequestHandler extends BaseRequestHandler
{
    use AuthorizesRequests;
    use EnforcesRequests, InteractsWithRequests, ValidatesRequests, DispatchesJobs;
}
