$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function removeRow(id, url){
    if (confirm('Bạn có chắc chắn muốn xóa mục này không ??')){
        $.ajax({
            type: "DELETE",
            datatype: "JSON",
            data: { id },
            url: url,
            success: function (result) {
                if (result.error == false) {
                    alert(result.massage);
                    location.reload();
                } else {
                    alert("Xóa không thành công. Vui lòng thử lại!");
                }
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi
                console.error(xhr.responseText); // In lỗi ra console để debug
                alert("Đã xảy ra lỗi. Vui lòng thử lại sau!");
            }
        });
    }
}


// upload

$('#upload').change(function(){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: form,
        url: '/admin/upload/services',
        success: function (results){
            if(results.error == false){
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' + 
            '<img src ="' + results.url + '" width="100px"></a>'
            
            );
                $("#thumb").val(results.url);   
            }
            else{
                alert('Upload File Lỗi');
            }
        }
    });
});