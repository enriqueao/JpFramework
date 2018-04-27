<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?=$this->render('Default','headDependencies',true);?>
  </head>
  <body onload="pushNotification('Aviso', '<?= $this->mensaje?>')">

  </body>
  <script type="text/javascript">
    setTimeout(function(){
      window.location.href = config.url;
    },1000);
  </script>
</html>
