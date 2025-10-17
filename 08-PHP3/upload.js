$(document).ready(function(){
    // Logika 1: Interaktivitas Tombol (Tombol 'Unggah' diaktifkan/dinonaktifkan)
    $('#file').change(function(){
        if (this.files.length > 0) {
            // Jika ada file yang dipilih: Hapus 'disabled', set opasitas ke 1 (aktif)
            $('#upload-button').prop('disabled', false).css('opacity', 1);
        } else {
            // Jika tidak ada file yang dipilih: Tambahkan 'disabled', set opasitas ke 0.5 (nonaktif)
            $('#upload-button').prop('disabled', true).css('opacity', 0.5);
        }
    });

    // Logika 2: Proses Unggah AJAX
    $('#upload-form').submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'upload_ajax.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){
                $('#status').html(response);
            },
            error: function(){
                $('#status').html('Terjadi kesalahan saat mengunggah file.');
            }
        });
    });
});