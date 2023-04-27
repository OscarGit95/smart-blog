const baseUrl = document.querySelector('#baseUrl').value;

const blogVariables = {
    topic: document.querySelector('#topic'),
    chatGPTButton: document.querySelector('#request_chatgpt_button'),
    responseChatGPT: document.querySelector('#chatgpt_response'),
    blogDate: document.querySelector('#blog_date'),
    saveBlogButton: document.querySelector('#form_save__button'),
    formBlog: document.querySelector('#form_save_blog'),
}

function initialInputs() {
    blogVariables.responseChatGPT.disabled = true;
    blogVariables.responseChatGPT.value = '';
}


function validateForm() {
    if(blogVariables.responseChatGPT.value.trim() == ""){
        isError = true;
        swalError("El contenido del blog está vacío");
        return false;
    }

    if(blogVariables.blogDate.value == ""){
        isError = true;
        swalError("Selecciona una fecha de expiración para tu blog");
        return false;
    }

    if(blogVariables.blogDate.value <= moment().format('YYYY-MM-DD')){
        isError = true;
        swalError("La fecha debe ser al menos un día posterior a hoy");
        return false;
    }
    return true;
}

blogVariables.chatGPTButton.addEventListener('click', () => {
    blogVariables.topic.classList.remove("form_blog__input_error");

    if(blogVariables.topic.value.trim() == ''){
        blogVariables.topic.classList.add("form_blog__input_error");
        swal("Ups!", "No has ingresado ningún tema para ChatGPT", "warning");
        return;
    }
    initialInputs();
    fetch(`${baseUrl}/blog/request-topic`, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type':'application/json'
        },
        method: 'POST',
        body: JSON.stringify({ topic: blogVariables.topic.value })
    })
    .then(response => response.json())
    .then(data => {
        const { role, content } = data;
        console.log(content)
        if(content.includes("I'm sorry,")){
            swal("Ups!", "No entendimos el tema que quisiste buscar. \n ¿Podrías darnos más contexto?", "warning");
        }else{
            blogVariables.responseChatGPT.style.height = "1px";
            blogVariables.responseChatGPT.style.height = (25 + blogVariables.responseChatGPT.scrollHeight) + "px";
            blogVariables.responseChatGPT.disabled = false;
            blogVariables.responseChatGPT.value = content;
        }
    })
    .catch(error => {
        blogVariables.responseChatGPT.disabled = false;
        swal("Ups!", error.message, "error");
    })
})

blogVariables.responseChatGPT.addEventListener('input', () => {
    blogVariables.responseChatGPT.style.height = "auto";
    blogVariables.responseChatGPT.style.height = (blogVariables.responseChatGPT.scrollHeight) + "px";
});

blogVariables.topic.addEventListener('change', () => {
    blogVariables.topic.classList.remove("form_blog__input_error");
});

blogVariables.formBlog.addEventListener('submit', (e) => {
    e.preventDefault();
    if(validateForm()){
        swal({
            title: "¿Publicamos tu blog?",
            text: "Revisa que contenga todo lo que deseas",
            icon: "info",
            buttons: ["Sí, publícalo 😊", "Aún no 😓"],
            dangerMode: true,
          })
          .then((willDelete) => {
            if(!willDelete) {
                $(e.target).closest('form').submit();
            } 
          });
    }
})

$(function(){
    
})