<?php
if (!isset($csrf_cookie_name)) {
    $ci = & get_instance();
    $csrf_cookie_name = $ci->config->item('csrf_protection') === true ? $ci->config->item('csrf_cookie_name') : '';
}
?>
<script type="text/javascript">
    var csrf_cookie_name = '<?php echo $csrf_cookie_name; ?>';
</script>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script type="text/javascript">
$(function(){
    $('.texteditor').each(function(e){
        CKEDITOR.replace( this.id, { customConfig: '/jblog/ckeditor/config_Large.js' });
    });
});
</script>
