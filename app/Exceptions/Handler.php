<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\SmsApiException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        //return parent::render($request, $e);
        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
                // not found
                case 404:
                    //return redirect()->back()->withFlashMessage('Route not found. Do not mess with delicate things...! :)')->withType('danger');
                    //return redirect('construction');
                    return redirect('404');
                    break;

                // internal error
                case '500':
                    return redirect()->back()->withFlashMessage('Serious server error Occurred. Things does not look good..! :(')->withType('danger');
                    break;

                default:
                    return $this->renderHttpException($e);
                    break;
            }
        } else {
            switch($e){
                case($e instanceof SmsApiException):
                    return $this->renderException($e);
                    break;
                default:
                    return parent::render($request, $e);
            }
        }
    }

    protected function renderException($e){
        return redirect()->back()->withFlashMessage($e->message)->withType('danger');
    }
}
