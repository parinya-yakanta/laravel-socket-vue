<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>DEMO node-rtsp-stream-jsmpeg</title>
  <script src="https://jsmpeg.com/jsmpeg.min.js"></script>
</head>
<body>
  <div>
    <canvas id="video-canvas">
    </canvas>
  </div>

  <script type="text/javascript">
  var url = "ws://localhost:3333";
  var canvas = document.getElementById('video-canvas');
  var player = new JSMpeg.Player(url, {canvas: canvas});
  console.log(player);
  </script>
</body>
