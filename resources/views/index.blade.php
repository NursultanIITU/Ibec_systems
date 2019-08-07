<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Test</title>
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/main.css">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            Фермочка для овечек
        </div>
        <div class="card-body">
            <div class="card-deck">

                @foreach($data as $number=>$zagons)
                    <div class="col-md-6 bot">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Загон {{$number}}</h5>
                                <p class="card-text">
                                <div class="form-group">
                                    <select multiple class="form-control" id="zagon{{$number}}">
                                        @foreach($zagons as $ovechki)
                                            <option value="{{$ovechki}}">{{$ovechki}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" id="start" class="btn btn-primary">Start</button>
            <a href="history" class="btn btn-success">History</a>
            <button type="button" class="btn btn-danger" id="nur">Update</button>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center">
                                <h1 class="display-4">Command </h1>

                                    <form action="" class="form-inlin justify-content-center">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="command" placeholder="Enter Command" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Result</label>
                                            <select id="zagon_command" class="form-control"></select>
                                            <select id="ovechka_command" class="form-control" style="margin-top: 15px"></select>
                                            <select id="moving_zagon_command" class="form-control" style="margin-top: 15px"></select>
                                        </div>
                                        <button type="button" id="command_btn" data-function="add" class="btn btn-success ">Execute</button>
                                    </form>

                            </div>
                        </div>
                    </div>

        </div>
    </div>

</div>
<script type="text/javascript" src="public/assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#nur').click(function() {
            location.reload();
        });
        $('#ovechka_command').hide();
        $('#moving_zagon_command').hide();

        $("input").blur(function(){
            var command=$('#command').val();
            command=command.toUpperCase();
            switch (command) {

                case 'ADD':
                    $('#ovechka_command').hide();
                    $('#moving_zagon_command').hide();
                    var ovechki = [];
                    var selects=[];
                    for(var i=0; i<4; i++) {
                        ovechki=[];
                        $.each($("#zagon"+(i+1)+" option"), function () {
                            ovechki.push($(this).val());
                        });
                        selects[i]=ovechki;
                    }
                    var zagons=[],z=0;
                    for(var i=0; i<4; i++)
                    {
                        zagons[z]=i+1;
                        z++;
                    }
                    var str="";
                    console.log(zagons);
                    str +="<option value='' disabled>Choose</option>"
                    for (i = 0; i < zagons.length; i++)
                    {
                        str += "<option value='" + zagons[i] + "'>Загон " + zagons[i] + "</option>";
                    }
                    $('#zagon_command').html(str);
                    break;

                case 'REMOVE':
                    var ovechki = [];
                    var selects=[];
                    for(var i=0; i<4; i++) {
                        ovechki=[];
                        $.each($("#zagon"+(i+1)+" option"), function () {
                            ovechki.push($(this).val());
                        });
                        selects[i]=ovechki;
                    }
                    var zagons=[],z=0;
                    for(var i=0; i<4; i++)
                    {
                        zagons[z]=i+1;
                        z++;
                    }
                    var str="";
                    console.log(zagons);
                    str +="<option disabled>Choose Zagon</option>"
                    for (i = 0; i < zagons.length; i++)
                    {
                        str += "<option value='" + zagons[i] + "'> Загон " + zagons[i] + "</option>";
                    }
                    $('#zagon_command').html(str);

                    $('#ovechka_command').show();

                    $("#zagon_command").change(function(){
                        var z=$('#zagon_command option:selected').val();
                        console.log(selects[z-1]);
                        var str2="";
                        str2 +="<option disabled>Choose Ovechka</option>"
                        for (i = 0; i < selects[z-1].length; i++)
                        {
                            str2 += "<option value='" + selects[z-1][i] + "'> Овечка " + selects[z-1][i] + "</option>";
                        }
                        $('#ovechka_command').html(str2);
                    });
                    break;
                case 'MOVE':
                    var ovechki = [];
                    var selects=[];
                    for(var i=0; i<4; i++) {
                        ovechki=[];
                        $.each($("#zagon"+(i+1)+" option"), function () {
                            ovechki.push($(this).val());
                        });
                        selects[i]=ovechki;
                    }
                    var zagons=[],z=0;
                    for(var i=0; i<4; i++)
                    {
                        zagons[z]=i+1;
                        z++;
                    }
                    var str="";
                    console.log(zagons);
                    str +="<option disabled>Choose Zagon</option>"
                    for (i = 0; i < zagons.length; i++)
                    {
                        str += "<option value='" + zagons[i] + "'> Загон " + zagons[i] + "</option>";
                    }
                    $('#zagon_command').html(str);

                    $('#ovechka_command').show();
                    $('#moving_zagon_command').show();
                    $("#zagon_command").change(function(){
                        var z=$('#zagon_command option:selected').val();
                        console.log(selects[z-1]);
                        var str2="";
                        str2 +="<option disabled>Choose Ovechka</option>"
                        for (i = 0; i < selects[z-1].length; i++)
                        {
                            str2 += "<option value='" + selects[z-1][i] + "'> Овечка " + selects[z-1][i] + "</option>";
                        }
                        $('#ovechka_command').html(str2);
                        var str3="";
                        str3 +="<option disabled>Choose Move Zagon</option>"
                        for (i = 0; i < zagons.length; i++)
                        {
                            if(zagons[i]!=z) {
                                str3 += "<option value='" + zagons[i] + "'> Загон " + zagons[i] + "</option>";
                            }
                        }
                        $('#moving_zagon_command').html(str3);

                    });

                    break;
                case '':
                    $('#zagon_command')
                        .empty();
                    $('#ovechka_command')
                        .empty();
                    $('#ovechka_command').hide();
                    $('#moving_zagon_command')
                        .empty();
                    $('#moving_zagon_command').hide();
                    $("input").val('');
                    alert('Enter command')
                    break;
                default:

                    alert('Invalid command')
                    break;
            }
            $("#command_btn").data("function",$(this).val());
        });



         $("#command_btn").click(function () {
             const functionName = $(this).data("function");
                switch (functionName) {
                    case "add":
                        var zagonid=$('#zagon_command option:selected').val();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'POST',
                            url: '{{route('add_by_command')}}',
                            data: {_token: CSRF_TOKEN, zagonid:zagonid},
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data.ovechki);
                                if(data.status==='success') {
                                    $('#zagon' + (zagonid)).append('<option>' + (data.ovechki++) + '</option>');
                                    $('#zagon_command')
                                        .empty();
                                    $("input").val('');
                                    alert("Successfully added by command")
                                }else{
                                    alert(data.message);
                                }
                            }
                        });
                        break;
                    case "remove":
                        var zagonid=$('#zagon_command option:selected').val();
                        var ovechkaid=$('#ovechka_command option:selected').val();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'POST',
                            url: '{{route('remove_by_command')}}',
                            data: {_token: CSRF_TOKEN, zagonid:zagonid,ovechkaid:ovechkaid},
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data.ovechki);
                                if(data.status==='success') {
                                    $("#zagon" + (zagonid) + " option[value='" + (ovechkaid) + "']").remove();
                                    $('#zagon_command')
                                        .empty();
                                    $('#ovechka_command')
                                        .empty();
                                    $('#ovechka_command').hide();
                                    $("input").val('');
                                    alert("Successfully removed by command");
                                }else{
                                    alert(data.message);
                                }
                            }
                        });
                        break;
                    case 'move':
                        var zagonid=$('#zagon_command option:selected').val();
                        var ovechkaid=$('#ovechka_command option:selected').val();
                        var moved_zagonid=$('#moving_zagon_command option:selected').val();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            type: 'POST',
                            url: '{{route('move_by_command')}}',
                            data: {_token: CSRF_TOKEN, zagonid:zagonid,ovechkaid:ovechkaid,moved_zagonid:moved_zagonid},
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data.ovechki);
                                if(data.status==='success') {
                                    $("#zagon" + (zagonid) + " option[value='" + (ovechkaid) + "']").remove();
                                    $('#zagon' + (moved_zagonid)).append('<option>' + (ovechkaid) + '</option>');
                                    $('#zagon_command')
                                        .empty();
                                    $('#ovechka_command')
                                        .empty();
                                    $('#ovechka_command').hide();
                                    $('#moving_zagon_command')
                                        .empty();
                                    $('#moving_zagon_command').hide();
                                    $("input").val('');
                                    alert("Successfully moved by command");
                                }else{
                                    alert(data.message);
                                }
                            }
                        });

                        break;
                    default:
                        break;
                }


         });


        $("#start").click(function(){
            var ovechki = [],selects=[];

            var max_zagon_number = max_zagon_length = min_zagon_length=min_zagon_number = 1;

            for(var i=0; i<4; i++) {
                ovechki=[];
                $.each($("#zagon"+(i+1)+" option"), function () {
                    ovechki.push($(this).val());
                });
                var len = ovechki.length;
                if(i==0)
                {
                    min_zagon_length=ovechki[i].length;
                }
                if (max_zagon_length < len){
                    max_zagon_length = len;
                    max_zagon_number = i+1;
                }
                if (min_zagon_length >= len){
                    min_zagon_length = len;
                    min_zagon_number = i+1;
                }
                selects[i]=ovechki;
            }

            // Add ovechki every 1 day
            setInterval(function() {
                var zagons=[],z=0;
                for(var i=0; i<4; i++)
                {
                    if(selects[i].length>1)
                    {
                        zagons[z]=i+1;
                        z++;
                    }
                }
                var ind = zagons[Math.floor(Math.random()*zagons.length)];
                console.log(ind);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                type: 'POST',
                url: '{{route('add')}}',
                data: {_token: CSRF_TOKEN, zagon_id:ind},
                dataType: 'JSON',
                success: function (data) {
                    if(data.status==='success') {
                        $('#zagon' + (ind)).append('<option>' + (data.ovechka_id++) + '</option>');
                    }else{
                        alert(data.message);
                    }
                }
                });
            }, 10000);

            // Remove ovechki from zagon every 10 days
            setInterval(function () {
                var remove_zagon_id=[],j=0;
                for(var i=0; i<4; i++)
                {
                    if(selects[i].length>1)
                    {
                        remove_zagon_id[j]=selects[i];
                        j++;
                    }
                }
                var zagon_number=Math.floor(Math.random()*remove_zagon_id.length);
                var zagons = remove_zagon_id[zagon_number];
                var ovechka_id = zagons[Math.floor(Math.random()*zagons.length)];

                console.log('zagons: '+zagons+' '+'Ovechka '+ovechka_id);
                console.log(zagon_number+1);

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '{{route('remove')}}',
                    data: {_token: CSRF_TOKEN, zagon_id:zagon_number+1, ovechka_id:ovechka_id},
                    dataType: 'JSON',
                    success: function (data) {
                        if(data.status==='success') {
                            $("#zagon" + (zagon_number+1) + " option[value='" + (ovechka_id) + "']").remove();
                        }else{
                            alert(data.message);
                        }
                    }
                });
            },30000);

            //add ovechki from max zagon to minimum zagon
            //console.log(max_zagon_number, max_zagon_length, min_zagon_number, min_zagon_length);
            if(min_zagon_length==1) {
                var max_zagon = selects[max_zagon_number - 1];
                var ovechka_id = max_zagon[Math.floor(Math.random() * max_zagon.length)];
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                console.log(min_zagon_length);
                $.ajax({
                    type: 'POST',
                    url: '{{route('move')}}',
                    data: {
                        _token: CSRF_TOKEN,
                        max_zagon_number: max_zagon_number,
                        min_zagon_number: min_zagon_number,
                        ovechka_id: ovechka_id
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status === 'success') {
                            $("#zagon" + (max_zagon_number) + " option[value='" + (ovechka_id) + "']").remove();
                            $('#zagon' + (min_zagon_number)).append('<option>' + (ovechka_id) + '</option>');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }



        });
    });
</script>
</body>
</html>