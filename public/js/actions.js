(function($) {

    $('.control').draggable({
        opacity: 0.35,
        revert: true,
        revertDuration: 100
    });

    $( "#form-builder" ).droppable({ accept: ".control" });

    $( "#form-builder" ).bind('drop', function(event, ui) {
        var link = ui.draggable.children();
        var id = link.attr('data-control');
        var cid = link.attr('data-cid');

        $(this).append($('#'+id).html());
        $('#form-builder .editable').blur(function () {
            var title = $(this).html();
            title = title.toLowerCase();
            title = title.replace(/ /g, '-');
            var input = $(this).parent().children()[1].children[0];
            input.id = input.id.substring(0, 3);
            input.id += title;
        });

    });

    $( ".control" ).bind( "click", function(event, ui) {
        var link = $(this).children();
        var id = link.attr('data-control');
        var cid = link.attr('data-cid');

        $('#form-builder').append($('#'+id).html());

        $("form").delegate(".component", "mousedown", function(md){
            md.preventDefault();
        });

         $('#form-builder .editable').blur(function () {
            var title = $(this).html();
            title = title.toLowerCase();
            title = title.replace(/ /g, '-');
            var input = $(this).parent().children()[1].children[0];
            input.id = input.id.substring(0, 3);
            input.id += title;
        });


    });


    //Nueva parte para el control de lista

    $('.help-inline a i.icon-plus').live('click', function(event, ui) {
        var parent = $(this).parent().parent().parent();
        var input = parent.find('input');
        var value = input.val();
        console.log('input select: ' + value);
        if (value !== '') {
            input.before('<div class="item-list"><span class="item">'+value+'</span><span class="help-inline"><a href="#"><i class="icon-minus"></i></a></span></div>');
            input.val('');
        }

    });

    $('.help-inline a .icon-minus').on('click', function(event, ui) {
        var parent = $(this).parent().parent().parent();
        parent.remove();
    });

    $( '#generateForm' ).click(function() {
        var control = [];
        var array = $('#form-builder .control-group');
        var template_id = $(this).attr('data-tid');

        for (var i = 0, max = array.length; i < max; i++) {
            c = {};
            c.order = i + 1;
            if ($(array[i]).attr('data-cid') === 'control-list') {
                c.name = $(array[i]).find('p.control-label').html();
                c.help = $(array[i]).find('.controls').find('p.help-block').html();
                c.multi = $(array[i]).find('.controls').find('p.multi-block').find('input').is(':checked');
                c.cid = $(array[i]).attr('id');
                c.type = $(array[i]).find('.controls').find('input').attr('id').substring(0, 2);
                c.items = [];
                var items = $(array[i]).find('.controls').find('.item-list span.item');
                for (var j = 0, jmax = items.length; j < jmax; j += 1) {
                    c.items.push(items[j].innerHTML);
                }
            } else {
                c.name = $(array[i]).children()[0].innerHTML;
                c.help = $(array[i]).children()[1].children[1].innerHTML;
                c.cid = $(array[i]).attr('id');
                c.type = $(array[i]).children()[1].children[0].id.substring(0, 2);
                c.multi = $(array[i]).find('.controls').find('p.multi-block').find('input').is(':checked');
            }

            control.push(c);
        }
        $.ajax({
            url: 'actions/setControlsData',
            type: "POST",
            data: {
                control: control,
                template: template_id
            },
            success: function(msg) {
                $alert = "<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>Template generated succesfully!<br> You can publish it to make it available or leave i as Draft.</div>";
                $('#buttonRack').before($alert);
                $('#publishForm').show();
            }
        });

    });

    $( '#publishForm' ).click(function() {
        $('#dynForm').submit();
    });

})(jQuery);
