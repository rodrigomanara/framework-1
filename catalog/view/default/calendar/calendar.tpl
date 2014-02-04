<link href='<?php echo $url; ?>/catalog/view/default/JS/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo $url; ?>/catalog/view/default/JS/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo $url; ?>/catalog/view/default/JS/lib/jquery.min.js'></script>
<script src='<?php echo $url; ?>/catalog/view/default/JS/lib/jquery-ui.custom.min.js'></script>
<script src='<?php echo $url; ?>/catalog/view/default/JS/fullcalendar/fullcalendar.min.js'></script>
<link href='<?php echo $url; ?>/catalog/view/default/CSS/style.css' rel='stylesheet' />
<link href='<?php echo $url; ?>/catalog/view/default/CSS/colorbox.css' rel='stylesheet' />
<script src="<?php echo $url; ?>/catalog/view/default/JS/colorbox-master/jquery.colorbox.js"></script>
<script type="text/javascript">
    function cleanText(text) {
        var str = text.split('=');
        return str[1];
    }
    function openWindow(url) {
       
       var rt = url.split('&');
       
       var patt = new RegExp('paciente'); 
       var id = <?php echo ($id_paciente > 0) ? 1 : 0 ;?>;
       var valida = false;
       
       for(var i = 0; i < rt.length ; i++ ){
            
            if(patt.test(rt[i]) !== false){
                var quebra = rt[i].split('='); 
                if(quebra[1] > 0){
                    valida = true;
                }
           }
       } 
        if(id === 0 && valida === false ){
            window.location = '<?php echo $url_add_paciente;?>';  
            return false;
        }  
        $.colorbox({
            iframe: true, width: "100%", height: "100%", href: url, onClosed: function() {
                location.reload();
            }
        });
    }
    $(document.body).ready(function() {
        $('#external-events div.external-event').each(function() {
            var eventObject = {
                title: $.trim($(this).text()), id_staff: $(this).attr('rel')
            };
            $(this).data('eventObject', eventObject);

            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });

        var calendar = $('#calendar').fullCalendar({
            //editable: true,
            droppable: true,
            selectable: true,
            //selectHelper: true,
            defaultView: 'agendaDay',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            minTime: '7:00',
            maxTime: '20:00',
            eventClick: function(calEvent, jsEvent, view) {
                var data = '';
                var p_id = (calEvent.id_paciente !== undefined) ? calEvent.id_paciente : <?php echo $id_paciente; ?>;
                var url = '';

                data += '&id_staff=' + calEvent.id_staff;
                data += '&id_paciente=' + p_id;
                data += '&start=' + $.fullCalendar.formatDate(calEvent.start, 'dd-MM-yyyy H:mm');
                data += '&end=' + $.fullCalendar.formatDate(calEvent.end, 'dd-MM-yyyy H:mm');
                data += '&id_calendar=' + calEvent.id;
                data += '&title=' + cleanText(calEvent.title);

                url = '<?php echo $url; ?>/calendar/home/Agendamento/' + data;
                openWindow(url);

                //$(this).css('border-color', 'red');
            }, eventMouseout: function(event, jsEvent, view) {
                $(this).css('border-color', '');
            }, drop: function(date, allDay) {
                var originalEventObject = $(this).data('eventObject');
                var copiedEventObject = $.extend({
                }, originalEventObject);
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);


            },
            eventSources: [{ url: '<?php echo $url; ?>/calendar/home/returnJsonCalendar/' + <?php if (isset($id_paciente)) { ?>'&id_paciente=<?php echo $id_paciente; ?><?php } ?>'}] 

        });
    });
</script>
<div class="desktop">
   
        <div id='external-events'>
            <h4> M&eacute;dico <div class="doctor"> &nbsp;</div></h4>
            <?php foreach ($cal_staff as $staff) { if($staff['level'] >= 10 and $staff['level'] <= 20 ){ ?> 
            <div class='external-event' style="background-color: <?php echo $staff['cor']; ;?>"   rel="<?php echo ucfirst($staff['id_staff']); ?>"><?php echo ucfirst($staff['name']) . " " . ucfirst($staff['surname']); ?></div>
            <?php } } ?>
           
        </div>
    <div id='external-events'>
         <h4> Funcionários <div class="doctor"> &nbsp;</div></h4>
            <?php foreach ($cal_staff as $staff) { if($staff['level'] < 10){ ?> 
            <div class='external-event' style="background-color: <?php echo "#" .$staff['cor']; ;?>"   rel="<?php echo ucfirst($staff['id_staff']); ?>"><?php echo ucfirst($staff['name']) . " " . ucfirst($staff['surname']); ?></div>
            <?php } } ?>
    </div>
    
    <div style="clear:both;height: 5px; width: 100%;"></div>
    <div class="desktop">
        <div id='calendar'></div>
    </div>
</div>