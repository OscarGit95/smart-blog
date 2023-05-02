@foreach($blogs as $blog)
    <div class="blog">
        <div class="blog_header">
            <h1>{{ $blog->topic }}</h1>
        </div>
        <div class="blog_content">
            <p>{!! nl2br(e($blog->blog)) !!}</p>
        </div>
        <div class="blog_footer">
            <p>{{\Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</p>
            <p>expira el {{\Carbon\Carbon::parse($blog->expires_at)->formatLocalized('%d de %B, %Y')}}</p>
            <div class="blog_options">
                <div>
                    <button type="button" class="edit_button" onclick="editModal({{$blog->id}})">Editar</button>
                </div>
                <div>
                    <form action="{{ url('/blog/delete/'.$blog->id) }}" method="POST" id="{{'form_delete_blog'.$blog->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete_button" onclick="deleteBlog({{$blog->id}})">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
