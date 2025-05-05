<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

/**
 * 自定义异常请求类
 */
class InvalidRequestException extends Exception
{
    //
    public function __construct(string $message = "", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
//        dd(22222);
//        die;
//        如果请求为json格式，则返回
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->message,
            ],$this->code);
        }

    }

}
