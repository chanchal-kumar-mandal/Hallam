<!DOCTYPE HTML>
<html>
  <head>
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    

    
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>  

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Datepicker CSS And Js files-->

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap-iso.css" />

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap-datepicker3.css"/>   

  </head>
  <body>
    <div class="col-md-4" style="margin-top:300px; width:200px;">
        <div class="form-group">
            <label class="control-label" for="date">Joinning Date:</label>
            <input class="form-control" id="date1" name="date1" type="text"/>
        </div>
    </div>
    <div class="col-md-4" style="margin-top:100px; width:200px;">
        <div class="form-group">
            <label class="control-label" for="date">Joinning Date:</label>
            <input class="form-control" id="date2" name="date2" type="text"/>
        </div>
    </div>
    <div class="col-md-4" style="margin-top:100px; width:200px;">
        <div class="form-group">
            <label class="control-label" for="date">Joinning Date:</label>
            <input class="form-control" id="date3" name="date3" type="text"/>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        $('#date1').datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        $('#date2').datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        $('#date3').datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    });
    </script>
  </body>
<html>