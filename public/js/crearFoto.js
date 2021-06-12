$(document).ready(function()
{
	$('#retrato').fileinput
        ({
        language: 'es',
        allowedFileExtensions: ['jpg','jpeg','png'],
        maxFileSize: 5000,
        showUpload: false,
        showClose: false,
        initialPreviewAsData: true,
        dropZoneEnabled: true,
        theme: "fas",
        });


 	$('#firma').fileinput
	({
		language: 'es',
		allowedFileExtensions: ['jpg','jpeg','png'],
		maxFileSize: 5000,
		showUpload: false,
		showClose: false,
		initialPreviewAsData: true,
		dropZoneEnabled: false,
		theme: "fas",
	});


   
});