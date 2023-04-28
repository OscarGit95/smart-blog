<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use App\Models\Blog;
use DB;


class BlogController extends Controller
{
    public function index(Request $request) {
        try{
            $blogs = Blog::where('user_id', auth()->user()->id)->whereNotIn('status_id', [3])->get();
           
            return view('blog.index', compact('blogs'));
        }catch(\Throwable $th){
            return back()->withErrors('Ocurrió un problema al ingresar a esta vista. Contacta a soporte técnico');
        }
    }

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

    public function store(Request $request) {
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
            return back()->with('success', 'Tu blog ha sido posteado con éxito');
        }catch(\Throwable $th){
            DB::rollback();
            return back()->with('errors', 'Ocurrió un problema al guardar tu post. Contacta a soporte técnico');
        }
    }

    public function edit($id){
        try{
            $blog = Blog::findOrFail($id);
            return response()->json($blog);

        }catch(\Throwable $th){
            return response()->json('errors', 'No pudimos encontrar la información. Contacta a soporte técnico', 500);
        }
    }

    public function update(Request $request, $id){
        try{
            DB::beginTransaction();
            $blog = Blog::findOrFail($id);
            $blog->topic = ($request->edit_topic) ? $request->edit_topic : 'Blog sin tema';
            $blog->blog = $request->edit_blog_content;
            $blog->expires_at = $request->blog_date;
            $blog->update();
            DB::commit();

            return back()->with('success', 'Tu blog ha sido actualizado con éxito');
        }catch(\Throwable $th){
            DB::rollback();
            return back()->with('errors', 'Ocurrió un problema al eliminar tu post. Contacta a soporte técnico');
        }
    }

    public function delete(Request $request, $id) {
        try{
            DB::beginTransaction();
            $blog = Blog::findOrFail($id);
            $blog->status_id = 3;
            $blog->save();
            DB::commit();

            return back()->with('success', 'Tu blog ha sido eliminado con éxito');
        }catch(\Throwable $th){
            DB::rollback();
            return back()->with('errors', 'Ocurrió un problema al eliminar tu post. Contacta a soporte técnico');
        }
    }
}
