<form name="document-file-scan" action="<?php echo $url; ?>">
    <input name="id_paciente" value="<?php echo $id; ?>" type="hidden"/>
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files" multiple>
    </span>
    <div class="clear">&nbsp;</div>
    <div id="doc-list"><?php foreach ($dados as $dados) { ?>
        <input name="fil_[name][<?php echo $dados['temp_id']; ?>]" value="<?php echo $dados['name']; ?>" type="hidden"/>
        <input name="fil_[id][<?php echo $dados['temp_id']; ?>]" value="<?php echo $dados['temp_id']; ?>" type="hidden"/>
        <li><a href="<?php echo $dados['content']; ?>" target="_blank"><?php echo $dados['name']; ?><a/></li>    
        <?php } ?></div>
    <div class="clear">&nbsp;</div>
</form>
<script>
    $(function() {
        /* activate the plugin */
        $('#fileupload').fileupload({
            type: 'post',
            url: '<?php echo $url_upload;?>',
            dataType: 'json',
            done: function(e, data) {

                $.each(data.files, function(index, value) {
                    returnForm(value.name);
                });

            }, progressall: function(e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css('width', progress + '%');
            }

        }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled').on('click', function() {
            $('#progress .progress-bar').css('width', '0%');
        });

        function returnForm(filename) {

            $.ajax({
                url: '<?php echo $url_upload;?>',
                data: '&id_paciente=' + <?php echo $id; ?> + '&get_Upload=true',
                dataType: 'json',
                type: 'post',
                success: function(element) {
                    $('#doc-list').html('');

                    var lista = "<ul>";
                    $.each(element, function(index, e) {
                        if (e.error === undefined) {
                            lista += '<input name="fil_[name][' + e.temp_id + ']" value="' + e.name + '" type="hidden"/>';
                            lista += '<input name="fil_[id][' + e.temp_id + ']" value="' + e.temp_id + '" type="hidden"/>';
                            $('#doc-list').append('<li><a href="' + e.content + '">' + e.name + lista + '</a></li>');
                        } else {
                            var error = "erro, arquivo falha ao salvar";
                            $('#doc-list').append(error);
                        }
                    });
                    lista += "</ul>";
                }
            });
        }
        function openFile() {

        }
        function deleteFile() {

        }
    });
</script>
<link rel="stylesheet" href="./catalog/view/default/JS/upload-file/css/jquery.fileupload.css">
<script src="./catalog/view/default/JS/upload-file/js/vendor/jquery.ui.widget.js"></script> 
<script src="./catalog/view/default/JS/upload-file/js/jquery.fileupload.js"></script>
<script src="./catalog/view/default/JS/upload-file/js/jquery.iframe-transport.js"></script> 
