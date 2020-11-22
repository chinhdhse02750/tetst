function createDropzone(url, token, buttonDelete, maxInput = 1) {
    Dropzone.autoDiscover = false;
    let uploadedDocumentMap = {};
    $('.dropzone[id]').each(function () {
        let selectedApped = $(this).parent().siblings('.previews-image');
        let max = maxInput;
        let nameInput = 'image';
        let nameClass = 'image';
        let showAlert = true;
        if (this.id === "video-dropzone") {
            return;
        }

        if (this.id === "image-product-dropzone") {
             nameInput = 'image[]';
             nameClass = 'image';
        }

        $(this).dropzone({
            url: url,
            autoDiscover: false,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            parallelUploads: 1,
            maxFiles: max,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            headers: {
                'X-CSRF-TOKEN': token
            },
            init: function () {

                this.on('success', function (file, response) {
                    if (!Dropzone.files || !Dropzone.files.length) {
                        uploadedDocumentMap[file.name] = response.data_media.name;
                        let dataImages = uploadSuccess(file.upload.uuid,
                            response.data_media.name, response.public_url,
                            response.data_media.size, response.data_media.name,
                            nameInput, buttonDelete, nameClass
                        );
                        selectedApped.append(dataImages);
                        file.previewElement.remove();
                    }
                });
                this.on("error", function (file, message) {
                    if (message.indexOf('Error 404') !== -1) {
                        let errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                        [errorDisplay.length - 1].innerHTML = 'Error 404: The upload page was not found on the server';
                    } else {
                         this.removeFile(file);
                         if(showAlert){
                             alert(message);
                         }
                        showAlert = false;
                    }
                });
            },
            queuecomplete: function (file) {
                showAlert = true;
                $('.dropzone').removeClass('dz-started');
                $('.dz-remove').on("click", function () {
                    let id = $(this).data("id");
                    $('#' + id + '').remove();
                    let count = $('.dz-image').length;
                    if ($(this).hasClass('image')) {
                        console.log(maxInput - count);
                        Dropzone.forElement('#image-product-dropzone').removeAllFiles(true);
                        Dropzone.forElement('#image-product-dropzone').options.maxFiles = maxInput - count;
                    }
                });

            },
        })
    });
}

function uploadSuccess(uuid, name, thumbnail, size, objValue, nameInput, buttonDelete, nameClass) {
    return `<div class="dz-image" id="${uuid}">
            <div class="image-frames"><img class="dz-image-display" alt="${name}" src = "${thumbnail}" ></div>         
            <input type="hidden" name="${nameInput}" value="${objValue}">
            <button type="button" class="btn btn-danger pull-right dz-remove ${ nameClass }" 
            data-dz-remove data-id="${uuid}" >${buttonDelete}</button>
            </div>`;
}

function createVideoDropzone(url, token, buttonDelete) {
    Dropzone.autoDiscover = false;
    let uploadedDocumentMap = {};
    $('#video-dropzone').dropzone({
        url: url,
        autoDiscover: false,
        maxFilesize: 50, // MB
        addRemoveLinks: true,
        parallelUploads: 1,
        acceptedFiles: ".mp4,.mkv,.avi",
        headers: {
            'X-CSRF-TOKEN': token
        },
        init: function () {
            this.on('success', function (file, response) {
                if (!Dropzone.files || !Dropzone.files.length) {
                    uploadedDocumentMap[file.name] = response.data_media.name;
                    let dataImages =
                        `<div class="dz-image" id="${file.upload.uuid}">
                            <video width="150" controls poster="${response.thumbnail_url}">
                            <source src="${response.public_url}" type="video/${response.data_media.type}">
                            </video>
                            <span class="file-size dz-name-display">${response.data_media.size}</span>
                            <input type="hidden" name="videos[]" value="${Object.values(response.data_media).join('|')}">
                            <button type="button" class="btn btn-danger pull-right dz-remove"
                            data-dz-remove data-id="${file.upload.uuid}" >${ buttonDelete }</button>
                            </div>`;
                    $('#video-previews').append(dataImages);
                    file.previewElement.remove();
                }
            });
            this.on("error", function (file, message) {
                alert(message);
                this.removeFile(file);
            });
        },
        queuecomplete: function (file) {
            $('#video-dropzone').removeClass('dz-started');
            $('.dz-remove').on("click", function () {
                let id = $(this).data("id");
                $('#' + id + '').remove();
            });
        },
    });
}
