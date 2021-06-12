$(document).ready(function()
{
	$('#certBachiller').fileinput
        ({
        language: 'es',
        allowedFileExtensions: ['pdf'],
        maxFileSize: 5000,
        showUpload: false,
        showClose: false,
        initialPreviewAsData: true,
        dropZoneEnabled: true,
        theme: "fas",
        });


 	$('#curp').fileinput
	({
		language: 'es',
		allowedFileExtensions: ['pdf'],
		maxFileSize: 5000,
		showUpload: false,
		showClose: false,
		initialPreviewAsData: true,
		dropZoneEnabled: false,
		theme: "fas",
	});


    $('#nacimiento').fileinput
    ({
        language: 'es',
        allowedFileExtensions: ['pdf'],
        maxFileSize: 5000,
        showUpload: false,
        showClose: false,
        initialPreviewAsData: true,
        dropZoneEnabled: true,
        theme: "fas",
    });
});