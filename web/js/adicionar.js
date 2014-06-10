$(document).ready(function() {
    $("<div><div id='inputImg'></div><div id='totalImg' style='margin-top: 15px;font-weight:700'></div><div  class='photos'></div></div>").insertAfter("#reclamacao_youtube");
    //$('<p id="termoBotao">Clicando em "Enviar reclamação", você afirma estar de acordo com o <a href="/termo-de-uso">Termo de Uso</a></p>').insertBefore("#reclamacao_Salvar");
});
 
function deleteImg(id){
    $("#tools"+id).remove();
    $("#imgReclamacao"+id).remove();
    totalImg--;
    $("#totalImg").html("Total de Imagens: " + totalImg);
}

var totalImg = 0;

if(document.querySelector('form input[type=file]')){
    
$(document).ready(function() {
    $("#reclamacao_Salvar").click(function() {
        var filesTarget = document.querySelector('form input[type=file]');
        filesTarget.value = '';
    });
});

// Once files have been selected
document.querySelector('form input[type=file]').addEventListener('change', function(event) {

// Read files
    var files = event.target.files;
    
// Iterate through files
    for (var i = 0; i < files.length; i++) {

// Ensure it's an image
        if (files[i].type.match(/image.*/)) {

// Load image
            var reader = new FileReader();
            reader.onload = function(readerEvent) {
                var image = new Image();
                image.onload = function(imageEvent) {

                    // Add elemnt to page
                    var imageElement = document.createElement('img');
                    imageElement.classList.add('uploading');
                    imageElement.innerHTML = '<span class="progress"><span></span></span>';
                    
                    var progressElement = imageElement.querySelector('span.progress span');
                    progressElement.style.width = 0;
                    
                    var divElement = document.createElement('div');
                    divElement.appendChild(imageElement);
                    document.querySelector('form div.photos').appendChild(divElement);
                    
                    
                    // Resize image
                    var canvas = document.createElement('canvas'),
                            max_size = 400,
                            width = image.width,
                            height = image.height;
                    
                    if (width > height) {
                        if (width > max_size) {
                            height *= max_size / width;
                            width = max_size;
                        }
                    } else {
                        if (height > max_size) {
                            width *= max_size / height;
                            height = max_size;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);


                    // Upload image
                    var xhr = new XMLHttpRequest();
                    if (xhr.upload) {


                        // Update progress
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = parseInt(event.loaded / event.total * 100);
                            progressElement.style.width = percent + '%';
                        }, false);


                        // File uploaded / failed
                        xhr.onreadystatechange = function(event) {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200) {
                                    
                                    imageElement.classList.remove('uploading');
                                    imageElement.classList.add('uploaded');
                                    imageElement.classList.add('img-thumbnail');
                                    
                                    var imgResponse = xhr.responseText;
                                    imageElement.src = "/tmp_send_image/"+imgResponse;
                                    
                                    imageElement.parentNode.id = "tools"+totalImg;
                                    
                                    $("#tools"+totalImg).append("<button style='margin-left:41px' class='btn btn-danger btn-xs' type='button' onclick='deleteImg("+totalImg+")' >Remover</button>");
                                    $("#inputImg").append("<input type='hidden' value='"+imgResponse+"' name='imgReclamacao["+totalImg+"]' id='imgReclamacao"+totalImg+"' />");
                                    //console.log('Image uploaded: ' + xhr.responseText);
                                    totalImg++;
                                    
                                    $("#totalImg").html("Total de Imagens: " + totalImg);
                                } else {
                                    imageElement.parentNode.removeChild(imageElement);
                                }
                            }
                        }

                        // Start upload
                        xhr.open('post', '/adicionar/foto', true);
                        xhr.send(canvas.toDataURL('image/jpeg'));
                    }

                }
                image.src = readerEvent.target.result;

            }
            reader.readAsDataURL(files[i]);
        }
    }
   // Clear files
   // event.target.value = '';    
});

}