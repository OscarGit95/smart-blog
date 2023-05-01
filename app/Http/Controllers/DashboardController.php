<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Carbon\Carbon;

/**
* @OA\Info(
*             title="Smart Blog", 
*             version="1.0",
*             description="Aplicación web que genera blogs con ayuda de ChatGPT"
* )
*
* @OA\Server(url="http://127.0.0.1:8000/")
*/


class DashboardController extends Controller
{
    /**
     * Listado de los blogs vigentes del usuario
     * @OA\Get (
     *     path="/api/",
     *     tags={"Inicio"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="user_id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="status_id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="topic",
     *                         type="string",
     *                         example="SpaceX"
     *                     ),
     *                     @OA\Property(
     *                         property="blog",
     *                         type="string",
     *                         example="Space Exploration Technologies Corp., conocida como SpaceX, es una empresa estadounidense de fabricación aeroespacial y de servicios de transporte espacial con sede en Hawthorne. Fue fundada en 2002 por Elon Musk con el objetivo de reducir los costes de viajar al espacio para facilitar la colonización de Marte.​​​"
     *                     ),
     *                     @OA\Property(
     *                         property="expires_at",
     *                         type="timestamp",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="timestamp",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="timestamp",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(){
        try{
            $blogs = Blog::where('user_id', auth()->user()->id)->where('expires_at', '>=', Carbon::now()->format('Y-m-d'))->whereNotIn('status_id', [3])->get();
            return view('dashboard', compact('blogs'));
        }catch(\Throwable $th){
            return back()->with('errors_function', 'Ha ocurrido un problema al cargar esta vista. Contacta a soporte técnico.');
        }
    }
}
