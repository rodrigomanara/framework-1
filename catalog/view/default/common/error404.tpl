<?php echo $header ; ?>
<div class="content">
    <span id="1" class='error404'>E</span>
    <span id="2" class='error404'>r</span>
    <span id="3" class='error404'>r</span>
    <span id="4" class='error404'>o</span>
    <span id="5" class='error404'>r</span>
    <span id="6" class='error404'> </span>
    <span id="7" class='error404'>4</span>
    <span id="8" class='error404'>0</span>
    <span id="9" class='error404'>4</span>
</div>
<script>
    $(document.body).ready(function() {

        $('.content > span[id]').each(function(){
            var context = $(this).attr('id');
            bouncetext(context);
        });

    });
    function bouncetext(element) {
        $("#"+element).animate({
                width: 'toggle',
                height: 'toggle'
             }, {
    duration: 5000,
    specialEasing: {
      width: 'linear',
      height: 'easeOutBounce'
    },
    complete: function() {
      $(this).fadeIn();
    }
  })
    }
</script>
<?php echo $bottom ; ?>