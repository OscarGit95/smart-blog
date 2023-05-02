<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Carbon\Carbon;
use DB;


class BlogController extends Controller
{
    /**
     * Listado de los blogs vigentes del usuario
     * @OA\Get (
     *     path="/blog",
     *     tags={"Blog"},
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
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="SERVER ERROR",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Ocurrió un problema al ingresar a esta vista. Contacta a soporte técnico"),
     *          )
     *      )
     *    )
     * )
     */
    public function index(Request $request) {
        try{
            $blogs = Blog::where('user_id', auth()->user()->id)->where('expires_at', '>=', Carbon::now()->format('Y-m-d'))->whereNotIn('status_id', [3])->get();
           
            return view('blog.index', compact('blogs'));
        }catch(\Throwable $th){
            return back()->with('errors_function', 'Ocurrió un problema al ingresar a esta vista. Contacta a soporte técnico');
        }
    }

     /**
     * Filtra los blogs por tema
     * @OA\Post (
     *     path="/blog/filter",
     *     tags={"Blog"},
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
     *                         property="filter",
     *                         type="string",
     *                         example="SpaceX"
     *                     ),
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=500,
     *          description="SERVER ERROR",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Ocurrió un problema al filtrar los blogs. Contacta a soporte técnico"),
     *          )
     *      )
     *    )
     * )
     */

    public function filter(Request $request){
        try{
            $blogs = Blog::where('user_id', auth()->user()->id)
                    ->where('topic', 'LIKE', '%'.$request->filter.'%')
                    ->where('expires_at', '>=', Carbon::now()->format('Y-m-d'))
                    ->whereNotIn('status_id', [3])->get();
           
            return view('blog.blogs', compact('blogs'));
        }catch(\Throwable $th){
            return back()->with('errors_function', 'Ocurrió un problema al filtrar los blogs. Contacta a soporte técnico');
        }
    }

    //Esta función consulta a la API de OpenAI 
    /**
     * Consulta a la API de OpenAI en su endpoint de ChatGPT
     * @OA\Post (
     *     path="/blog/request-topic",
     *     tags={"Blog"},
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
     *                         property="topic",
     *                         type="string",
     *                         example="SpaceX"
     *                     ),
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function requestTopic(Request $request) {

        $chatGPTData = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
        ])
        ->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $request->topic
                ]
            ],
            'temperature' => 0.5,
            'max_tokens' => 200,
            'top_p' => 1.0,
            'frequency_penalty' => 0.52,
            'presence_penalty' => 0.5,
            'stop' => ['11.'],
        ])->json();

        return response()->json($chatGPTData['choices'][0]['message']);
    }

    //Esta función valida y guarda los blogs
    /**
     * Crear un blog
     * @OA\Post (
     *     path="/blog/store",
     *     tags={"Blog"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                  @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="topic",
     *                         type="string",
     *                         example="SpaceX"
     *                     ),
     *                     @OA\Property(
     *                         property="chatgpt_response",
     *                         type="string",
     *                         example="Space Exploration Technologies Corp., conocida como SpaceX, es una empresa estadounidense de fabricación aeroespacial y de servicios de transporte espacial con sede en Hawthorne. Fue fundada en 2002 por Elon Musk con el objetivo de reducir los costes de viajar al espacio para facilitar la colonización de Marte.​​​"
     *                     ),
     *                     @OA\Property(
     *                         property="blog_date",
     *                         type="timestamp",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=500,
     *          description="SERVER ERROR",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Ocurrió un problema al guardar tu post. Contacta a soporte técnico"),
     *          )
     *      )
     *   )
     * )
     */
    public function store(BlogRequest $request) {
        try{
            DB::beginTransaction();
            Blog::create([
                'user_id' => auth()->user()->id,
                'status_id' => 1,
                'topic' => ($request->topic) ? $request->topic : 'Blog sin tema',
                'blog' => $request->chatgpt_response,
                'expires_at' => $request->blog_date
            ]);
            DB::commit();
            return back()->with('success_function', 'Tu blog ha sido posteado con éxito');
        }catch(\Throwable $th){
            DB::rollback();
            return back()->with('errors_function', 'Ocurrió un problema al guardar tu post. Contacta a soporte técnico');
        }
    }

    //Esta función consulta por la ID del usuario
     /**
     * Muestra la información de un blog
     * @OA\Get (
     *     path="/blog/{id}",
     *     tags={"Blog"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="user_id", type="number", example=1),
     *              @OA\Property(property="status_id", type="number", example=1),
     *              @OA\Property(property="topic", type="string", example="Elon Musk"),
     *              @OA\Property(property="blog", type="string", example="Elon Reeve Musk (Pretoria, 28 de junio de 1971), conocido como Elon Musk, es un empresario, inversor y magnate sudafricano que también posee las nacionalidades canadiense y estadounidense. Es el fundador, consejero delegado e ingeniero jefe de SpaceX; inversor ángel, CEO y arquitecto de productos de Tesla, Inc"),
     *              @OA\Property(property="expires_at", type="timestamp", example="2023-06-10T00:09:16.000000Z"),
     *              @OA\Property(property="created_at", type="timestamp", example="2023-05-10T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="timestamp", example="2023-05-10T00:09:16.000000Z"),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No pudimos encontrar la información. Contacta a soporte técnico"),
     *          )
     *      )
     * )
     */
    public function edit($id){
        try{
            $blog = Blog::findOrFail($id);
            return response()->json($blog);

        }catch(\Throwable $th){
            return response()->json('errors_function', 'No pudimos encontrar la información. Contacta a soporte técnico', 404);
        }
    }

    //Esta funcion valida y actualiza el blog
    /**
     * Actualiza un blog
     * @OA\Put (
     *     path="/blog/{id}",
     *     tags={"Blog"},
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                  @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="edit_topic",
     *                         type="string",
     *                         example="SpaceX"
     *                     ),
     *                     @OA\Property(
     *                         property="edit_blog_content",
     *                         type="string",
     *                         example="Space Exploration Technologies Corp., conocida como SpaceX, es una empresa estadounidense de fabricación aeroespacial y de servicios de transporte espacial con sede en Hawthorne. Fue fundada en 2002 por Elon Musk con el objetivo de reducir los costes de viajar al espacio para facilitar la colonización de Marte.​​​"
     *                     ),
     *                     @OA\Property(
     *                         property="edit_blog_date",
     *                         type="timestamp",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=500,
     *          description="SERVER ERROR",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Ocurrió un problema al eliminar tu post. Contacta a soporte técnico"),
     *          )
     *      )
     *   )
     * )
     */
    public function update(BlogRequest $request, $id){
        try{
            DB::beginTransaction();
            $blog = Blog::findOrFail($id);
            $blog->topic = ($request->edit_topic) ? $request->edit_topic : 'Blog sin tema';
            $blog->blog = $request->edit_blog_content;
            $blog->expires_at = $request->edit_blog_date;
            $blog->update();
            DB::commit();

            return back()->with('success_function', 'Tu blog ha sido actualizado con éxito');
        }catch(\Throwable $th){
            DB::rollback();
            return back()->with('errors_function', 'Ocurrió un problema al eliminar tu post. Contacta a soporte técnico');
        }
    }

    //Esta funcion elimina de manera lógica el blog
    /**
     * Elimina un blog
     * @OA\Delete (
     *     path="/blog/{id}",
     *     tags={"Blog"},
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *      @OA\Response(
     *          response=500,
     *          description="SERVER ERROR",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Ocurrió un problema al eliminar tu post. Contacta a soporte técnico"),
     *          )
     *      ),
     *  )
     */
    public function delete(Request $request, $id) {
        try{
            DB::beginTransaction();
            $blog = Blog::findOrFail($id);
            $blog->status_id = 3;
            $blog->save();
            DB::commit();

            return back()->with('success_function', 'Tu blog ha sido eliminado con éxito');
        }catch(\Throwable $th){
            DB::rollback();
            return back()->with('errors_function', 'Ocurrió un problema al eliminar tu post. Contacta a soporte técnico');
        }
    }
}
