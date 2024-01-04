<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/backend.css">
    <title>Panel Admin | Hotel Ebony</title>

    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">

    <?= $this->renderSection("head") ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?= view("_layouts/navbar") ?>

<?= $this->renderSection("content") ?>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    async function triggerSave(element) {
        const group_name = element.name.split("_")[0]
        const apiUrl = '/object/lines/update/<?= session()->get("LANG") ?>/' + group_name;

        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                [element.name]: element.value,
            })
        };

        fetch(apiUrl, requestOptions)
            .then(data => {
                console.log(data);
                const saved = "<span class='text-success fw-bolder'> (auto-saved)</span>"
                const label = $(`label[for="${element.name}"]`);
                if (label.children("span").length === 0) {
                    label.append(saved)
                    setTimeout(function () {
                        label.children("span").remove()
                    }, 2000);
                }
            })
            .catch(error => {
                console.error(error)
            });
    }

    async function handleInputChange(event) {
        await triggerSave(event.target)
    }

    document.addEventListener("DOMContentLoaded", () => {
        const fields = document.getElementsByClassName("autosaving_field")

        for (const field of fields) {
            field.onkeyup = handleInputChange;
            field.onchange = handleInputChange;
        }
    })
</script>

<script src="<?= base_url("/js/ckeditor/ckeditor.js") ?>"></script>
<script>
    class MyUploadAdapter {
        constructor(loader) {
            // The file loader instance to use during the upload.
            this.loader = loader;
        }

        // Starts the upload process.
        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }

        // Aborts the upload process.
        abort() {
            if (this.xhr) {
                this.xhr.abort();
            }
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open('POST', '<?= route_to("object.lines.dumpUpload")?>', true);
            xhr.responseType = 'json';
        }

        // Initializes XMLHttpRequest listeners.
        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${file.name}.`;

            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve({
                    default: response.url
                });
            });

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }

        // Prepares the data and sends the request.
        _sendRequest(file) {
            // Prepare the form data.
            const data = new FormData();

            data.append('upload', file);

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send(data);
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    function initCkeditor(id) {
        DecoupledDocumentEditor
            .create(document.querySelector(`.editor${id}`), {
                language: 'en',
                extraPlugins: [MyCustomUploadAdapterPlugin],
            })
            .then(editor => {
                window.editor = editor;
                editor.model.document.on('change', () => {
                    document.getElementById(id).value = editor.getData();
                });
            })
    }
</script>

<script>
    function bindSelectToPreview(id, callback) {
        document.getElementById(id).addEventListener('change', (event) => {
            callback(event.target.value)
        })
    }

    function bindInputToPreview(id) {
        document.getElementById(id).addEventListener('keyup', (event) => {
            for (let element of document.getElementsByClassName('preview_' + id)) {
                element.innerText = event.target.value
            }
        })
    }

    function bindInputImageToPreview(id) {
        document.getElementById(id).addEventListener('change', function () {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                for (let element of document.getElementsByClassName('preview_' + id)) {
                    element.src = e.target.result;
                }
            };

            reader.readAsDataURL(file);
        });
    }

    function confirmBeforeSubmit(element, title = 'Konfirmasi?', subtitle) {
        function findFormParent(element) {
            if (element.tagName === 'FORM') {
                return element; // If the current element is a form, return it
            } else if (element.parentElement) {
                // If the current element has a parent, recursively check the parent
                return findFormParent(element.parentElement);
            } else {
                return null; // If there's no parent or form found, return null
            }
        }

        Swal.fire({
            title: title,
            text: subtitle,
            showCancelButton: true,
            confirmButtonText: "Konfirmasi",
        }).then((result) => {
            if (result.isConfirmed) {
                const form = findFormParent(element);
                form.submit();
            }
        });
    }
</script>
<?= $this->renderSection("javascript") ?>

<?php if (isset($flashdata['success'])): ?>
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "<?= $flashdata['success'] ?>",
            icon: "success"
        });
    </script>
<?php endif ?>

</body>
</html>