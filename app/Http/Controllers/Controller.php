<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
 * @OA\Info(
 *    title="TO DO LIST  - DOCUMENTATION",
 *    version="1.0.0",
 *    description="API documentation ",
 *    @OA\Contact(
 *        email="jonascportugal30@gmail.com"
 *    )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     in="header",
 *     name="Authorization",
 *     description="Use 'Bearer {token}' to authentication"
 * )
 */
}
