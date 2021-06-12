$(document).ready(function()
{
	$('#baucher').fileinput
        ({
        language: 'es',
        allowedFileExtensions: ['jpg','jpeg','png'],
        maxFileSize: 8000,
        showUpload: false,
        showClose: false,
        initialPreviewAsData: true,
        dropZoneEnabled: true,
        theme: "fas",
        });

   
});