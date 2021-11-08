$(document).ready(function () {
    // tab login dan sign up
    $('.nav-link').on('click', function (e) {
	e.preventDefault()
	$('.nav-link').removeClass('aktif')
	$(this).addClass('aktif')
    })
    
    // preview ketika user memilih foto
    const foto = $('#foto')
    const thumb = $('.figure-img')
    $('#foto').change(function () {
    	const file = foto[0].files[0]
    	thumb.attr('src', URL.createObjectURL(file))
    });

});
//ketika foto dipilih, ganti kalimat 'pilih foto' jadi sama dengan nama file yg dipilih
const gantiValueLabel = (e) => e.labels[0].textContent = e.files[0].name