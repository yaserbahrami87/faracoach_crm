$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function()
{


    $("#state").change(function()
    {
        var state=$(this).val();
        $.ajax({
            type:'GET',
            url:"/panel/state/"+state,
            success:function(data)
            {
                $("#city").html(data);
            }
        });
    });

    $(".btn-modal-introduced").click(function()
    {
        var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
        $("#modal_introduced_profile .modal-body").html(loading);
        var user=$(this).attr('href');
        $.ajax({
            type:'GET',
            url:"/panel/userAjax/"+user,
            success:function(data)
            {
                $("#modal_introduced_profile .modal-body").html(data);
            }
        });
    });

    $('.showDetailsMessage').click(function(e)
    {
        e.preventDefault();
        var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
        $("#showDetailsMessage").html(loading);
        var user=$(this).attr('href');
        if(user!="new")
        {
            $.ajax({
                type:'GET',
                url:"/panel/messages/show/"+user,
                success:function(data)
                {
                    jQuery("#showDetailsMessage").html(data);
                }
            });
        }
        else
        {
            $.ajax({
                type:'GET',
                url:"/panel/messages/new",
                success:function(data)
                {
                    $("#showDetailsMessage").html(data);
                }
            });
        }
    });

    $('.showDetailsMessageUser').click(function(e)
    {
        e.preventDefault();
        var loading='<div class="col-12 text-center"><div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div></div>';
        $("#showDetailsMessage").html(loading);
        var user=$(this).attr('href');
        if(user!="new")
        {
            $.ajax({
                type:'GET',
                url:"/admin/messages/show/"+user,
                success:function(data)
                {
                    jQuery("#showDetailsMessage").html(data);
                }
            });
        }
        else
        {
            $.ajax({
                type:'GET',
                url:"/admin/messages/new",
                success:function(data)
                {
                    $("#showDetailsMessage").html(data);
                }
            });
        }
    });

});

