<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch(Route::getCurrentRoute()->getActionMethod()){
            case "store":
                return [
                    "chatgpt_response" => "required",
                    "blog_date" => "required|date|after:".Carbon::now()->format('Y-m-d')
                ];
            break;
            case "update":
                return [
                    "edit_blog_content" => "required",
                    "edit_blog_date" => "required|date|after:".Carbon::now()->format('Y-m-d')
                ];
            break;
        }
    }

    public function messages(){
        switch(Route::getCurrentRoute()->getActionMethod()){
            case "store":
                return [
                    "chatgpt_response.required" => "El contenido del blog es requerido",
                    "blog_date.required" => "La fecha de vencimiento es requerida",
                    "blog_date.date" => "La fecha de vencimiento debe ser una fecha válida",
                    "blog_date.after" => "La fecha debe ser al menos un día posterior a hoy",
    
                ];
            break;
            case "update":
                return [
                    "edit_blog_content.required" => "El contenido del blog es requerido",
                    "edit_blog_date.required" => "La fecha de vencimiento es requerida",
                    "edit_blog_date.date" => "La fecha de vencimiento debe ser una fecha válida",
                    "edit_blog_date.after" => "La fecha debe ser al menos un día posterior a hoy",
    
                ];
            break;
        }
    }
}
