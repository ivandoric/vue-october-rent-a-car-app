<?php

namespace OFFLINE\CORS\Classes;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Based on asm89/stack-cors
 */
class Cors implements HttpKernelInterface
{
    /**
     * @var \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    private $app;

    /**
     * @var CorsService
     */
    private $cors;

    private $defaultOptions = [
        'allowedHeaders'      => [],
        'allowedMethods'      => [],
        'allowedOrigins'      => [],
        'exposedHeaders'      => false,
        'maxAge'              => false,
        'supportsCredentials' => false,
    ];

    /**
     * Cors constructor.
     *
     * @param HttpKernelInterface $app
     * @param array               $options
     */
    public function __construct(HttpKernelInterface $app, array $options = [])
    {
        $this->app  = $app;
        $this->cors = new CorsService(array_merge($this->defaultOptions, $options));

    }

    /**
     * @param Request $request
     * @param int     $type
     * @param bool    $catch
     *
     * @return bool|Response
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        if ( ! $this->cors->isCorsRequest($request)) {
            return $this->app->handle($request, $type, $catch);
        }

        if ($this->cors->isPreflightRequest($request)) {
            return $this->cors->handlePreflightRequest($request);
        }

        if ( ! $this->cors->isActualRequestAllowed($request)) {
            return new Response('Not allowed.', 403);
        }

        $response = $this->app->handle($request, $type, $catch);

        return $this->cors->addActualRequestHeaders($response, $request);
    }
}