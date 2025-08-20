const {
    ClassicEditor,
    Essentials,
    Heading,
    Bold,
    Italic,
    Font,
    Paragraph,
    Image,
    ImageCaption,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    LinkImage,
    ImageInsert,
    ImageUpload,
    SimpleUploadAdapter,
    ImageEditing,
    ImageBlockEditing,
    List,
    Link,
} = CKEDITOR;

ClassicEditor
    .create(document.querySelector('#editor'), {
        plugins: [
            Essentials, Heading, Bold, Italic, Font, Paragraph, 
            Image, // Ensure Image plugin is included
            ImageCaption, ImageResize, ImageStyle, ImageToolbar, 
            LinkImage, ImageInsert, ImageUpload, SimpleUploadAdapter, 
            ImageEditing, ImageBlockEditing, List, Link,
        ],
        toolbar: [
            'heading', '|',
            'imageInsert', '|',
            'undo', 'redo', '|',
            'bold', 'italic', '|',
            'bulletedList', 'numberedList', '|',
            'link',
        ],
        link: {
            addTargetToExternalLinks: true
        },
        image: {
            toolbar: [
                'imageStyle:block', 'imageStyle:side', '|',
                'toggleImageCaption', 'imageTextAlternative', '|',
                'linkImage'
            ],
            insert: {
                type: 'auto'
            }
        }, 
        simpleUpload: {
            // uploadUrl: configBaseDir + 'scripts/upload_image2.php', 
            uploadUrl: configBaseDir + 'api/ckeditor_upload'
        }
    })
    .then(editor => {
        console.log('Editor was initialized', editor);
        
        // Listen to file upload events
        editor.plugins.get('SimpleUploadAdapter').on('uploadStarted', (evt, data) => {
            console.log('Upload started:', data);
        });
        
        editor.plugins.get('SimpleUploadAdapter').on('uploadSuccess', (evt, data) => {
            console.log('Upload successful:', data);
            console.log('Server response:', data.response);
        });
        
        editor.plugins.get('SimpleUploadAdapter').on('uploadError', (evt, data) => {
            console.error('Upload error:', data);
            console.error('Error response:', data.error && data.error.response);
        });
        
        editor.plugins.get('SimpleUploadAdapter').on('uploadComplete', (evt, data) => {
            console.log('Upload complete:', data);
        });
    })
    // .then(/* ... */)
    .catch(error => {
        console.error('There was an error initializing the editor:', error);
    });

    console.log(configBaseDir + 'scripts/upload_image.php');