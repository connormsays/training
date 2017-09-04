$('#courses').change(function(){
var id = $(this).val();

$.ajax({
            type: "POST",
            url: "./dist/js/ajax/getModules.php",
            data: { 'id': id  },
            success: function(data){
                // Parse the returned json data
                var opts = $.parseJSON(data);
                $('#modules').removeAttr('disabled');
                $.each(opts, function(i, d) {
                    $('#modules').append('<option value="' + d.module.module_id + '">' + d.module.name + '</option>');
                });

            }
        });
});