<?php echo $header ;?>
<?php echo $menu ;?>
<link href='./catalog/view/default/JS/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='./catalog/view/default/JS/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='./catalog/view/default/JS/lib/jquery.min.js'></script>
<script src='./catalog/view/default/JS/lib/jquery-ui.custom.min.js'></script>
<script src='./catalog/view/default/JS/fullcalendar/fullcalendar.min.js'></script>
<link href='./catalog/view/default/CSS/colorbox.css' rel='stylesheet' />
<script src="./catalog/view/default/JS/colorbox-master/jquery.colorbox.js"></script>
<style>
    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
        margin-left:5px; 
    }
    .external-event { /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
    }
</style>
<script>

    $(document).ready(function() {


        $('#external-events div.external-event').each(function() {

            var eventObject = {
                title: $.trim($(this).text())
            };

            $(this).data('eventObject', eventObject);

            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });

        var calendar = $('#calendar').fullCalendar({
            editable: true, 
            droppable: true,
            selectable: true,
            selectHelper: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                                                {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            }, true
                            );
                }
                calendar.fullCalendar('unselect');
            },
            eventClick: function(calEvent, jsEvent, view) {
                var data = '&start=' + $.fullCalendar.formatDate(calEvent.start, 'dd-MM-yyyy H:mm') + '&end=' + $.fullCalendar.formatDate(calEvent.end, 'dd-MM-yyyy H:mm') + '&title=' + calEvent.title;
                data += '&id' + calEvent.id ;
                var url = './calendar/home/addAgendamento/' + data;

                openWindow(url);

                $(this).css('border-color', 'red');
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
            eventSources: [{
                    url: './calendar/home/returnJsonCalendar/'
                }]

        });

        function openWindow(url) {
            $.colorbox({
                iframe: true, width: "650px", height: "80%", href: url, onClosed: function() {
                    location.reload();
                }
            });
        }
    });

</script>
<div id='external-events'>
    <h4>Criar Agendamento</h4>
    <div class='external-event'>agendamento</div>
</div>
<div class="desktop">

    <div id='calendar'></div>
</div>
<?php echo $bottom ;?>